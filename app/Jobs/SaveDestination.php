<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Setting;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use SKAgarwal\GoogleApi\PlacesApi;
use Throwable;

class SaveDestination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $timeout = 3600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public array $destinations) {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle() {
        Setting::findByType('saving_destinations')->update(['description' => true]);

        $destinations = $this->destinations;

        error_log('--------------...Starting to save...--------------');

        try {
            $i = 1;
            foreach($destinations as $destination) {
                if($destination['photo']) {
                    error_log("$i. Saving destination and details for..." . $destination['name']);

                    $photo = $destination['photo'];

                    $categoryTitle = Arr::first($destination['types']);
                    $category = ['title' => $categoryTitle];
                    Category::updateOrCreate($category, $category);

                    error_log("------  Saved category... : " . $categoryTitle . "!");

                    $destination = Destination::updateOrCreate(['place_id' => $destination['place_id']],
                        appendToApiDestination($destination));

                    if(empty($destination->image)) {
                        $destination->image = downloadPhoto($photo);
                        $destination->save();
                    }

                    $this->processDetails($destination);

                    error_log("------  Saved photos!");
                }

                $i++;
            }

            error_log("All destinations have been saved successfully");
        } catch (Exception | Throwable $e) {
            error_log("---------------!!!An error occurred while saving destinations!!!---------------");
            error_log($e->getMessage());
        }

        Setting::findByType('saving_destinations')->update(['description' => false]);
    }

    /**
     * ======================================================================    HELPER METHODS
     *
     * @throws GuzzleException
     */
    public function processDetails(Destination $destination) {
        $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));

        $params = [
            'place_id' => $destination->place_id,
            'key'      => $googlePlaces->getKey(),
        ];

        $endpoint = config('google.places.base_url') . "details/json?" . http_build_query($params);
        $response = json_decode((new Client())->get($endpoint)->getBody()->getContents(), true);

        $result = $response['result'];

        if(isset($result['opening_hours'])) {
            $destination->availability = $result['opening_hours'];
            $destination->save();
        }

        //  SAVE DESTINATION REVIEWS & PHOTOS *IF NOT EXISTS
        savePhotosAndReviews($destination, $result);
    }
}
