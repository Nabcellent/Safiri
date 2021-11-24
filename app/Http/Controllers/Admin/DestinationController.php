<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Jobs\SaveDestination;
use App\Models\Category;
use App\Models\Destination;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use SKAgarwal\GoogleApi\PlacesApi;
use Throwable;

class DestinationController extends Controller
{
    public function index(): Response {
        $data = [
            'destinations' => Destination::with('category')->take(100)->latest()->get()
        ];

        return response()->view('admin.destinations.list', $data);
    }

    public function show($id): Response|RedirectResponse {
        try {
            $data = [
                'destination' => Destination::with(['category' => function($query) {
                    $query->select(['id', 'title']);
                }, 'destinationImages' =>function($query) {
                    $query->select(['id', 'destination_id', 'image']);
                }, 'reviews' => function($query) {
                    $query->take(3)->select(['id', 'user_id', 'destination_id']);
                }])->withCount(['reviews', 'bookings'])->findOrFail($id),
            ];

            return response()->view('admin.destinations.show', $data);
        } catch (Exception $e) {
            return toastError($e->getMessage(), "Something went wrong!");
        }
    }

    public function create(): Response {
        $data = [
            'categories' => Category::select(['id', 'title'])->get(),
        ];

        return response()->view('admin.destinations.upsert', $data);
    }

    public function store(StoreDestinationRequest $request): RedirectResponse {
        $data = $request->except(['_token', '_method']);

        try {
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $data['image'] = "dest_" . time() . ".{$file->guessClientExtension()}";
                $file->move(public_path('images/destinations'), $data['image']);
            }

            $destination = Destination::create($data);

            $this->storeOtherImages($request, $destination);

            return createOk('Destination created successfully', 'admin.destinations.index');
        } catch (Exception $e) {
            return toastError($e->getMessage(), "Unable to create destination");
        }
    }

    public function edit(int $id): Response|RedirectResponse {
        try {
            $data = [
                'categories' => Category::select(['id', 'title'])->get(),
                'destination' => Destination::findOrFail($id),
            ];

            return response()->view('admin.destinations.upsert', $data);
        } catch (Exception $e) {
            return toastError($e->getMessage(), "Something went wrong!");
        }
    }

    public function update(Request $request, int $id): RedirectResponse {
        $data = $request->except(['_token', '_method']);

        try {
            $destination = Destination::findOrFail($id);

            unset($data['image']);

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $data['image'] = "dest_" . time() . ".{$file->guessClientExtension()}";
                $file->move(public_path('images/destinations'), $data['image']);

                if(isset($destination->image) && file_exists("images/destinations/{$destination->image}")) {
                    unlink(public_path('images/destinations/' . $destination->image));
                }
            }

            $this->storeOtherImages($request, $destination);

            $destination->update($data);

            return createOk('Destination updated successfully', 'admin.destinations.index');
        } catch (Exception $e) {
            return toastError($e->getMessage(), "Unable to update destination.");
        }
    }

    /**
     * @param StoreDestinationRequest $request
     * @param Destination             $destination
     * @return void
     */
    private function storeOtherImages(Request $request, Destination $destination): void {
        if($request->hasFile('other_images')) {
            $files = $request->file('other_images');
            $otherImages = [];

            foreach($files as $image) {
                $imageName = "dest_" . uniqid() . ".{$image->guessClientExtension()}";
                array_push($otherImages, [
                    'image'          => $imageName,
                    'destination_id' => $destination->id,
                ]);
                $image->move(public_path('images/destinations'), $imageName);
            }

            $destination->destinationImages()->insert($otherImages);
        }
    }



    /**
     * @return Response
     */
    public function apiIndex(): Response {
        $data['savingDestinations'] = getSetting('saving_destinations');

        return response()->view('admin.destinations.index', $data);
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function storeApi(Request $request): JsonResponse {
        if($request->has('destinations')) {
            SaveDestination::dispatch($request->input('destinations'));

            return response()->json(['status' => true, 'message' => 'Saving destinations in background...']);
        } else if($request->has('place_id')) {
            $googlePlaces = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));
            $result = $googlePlaces->placeDetails($request->input('place_id'))['result'];
            $photos = $result['photos'];

            $category = ['title' => Arr::first($result['types'])];
            Category::updateOrCreate($category, $category);

            if(isset($result['opening_hours'])) $result['availability'] = $result['opening_hours'];

            $destination = Destination::updateOrCreate(['place_id' => $request->input('place_id')],
                appendToApiDestination($result));

            if(isset($destination->image) && file_exists("images/destinations/{$destination->image}")) {
                unlink(public_path('images/destinations/' . $destination->image));
            }

            $destination->image = downloadPhoto(getPhotoUrl(array_shift($photos)['photo_reference']));
            $destination->save();

            //  SAVE DESTINATION REVIEWS & PHOTOS *IF NOT EXISTS
            if(savePhotosAndReviews($destination, $result)) {
                return response()->json(['status' => true, 'message' => 'Destination saved successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Error saving destination assets!']);
            }
        }

        return response()->json(['status' => false, 'message' => 'No destination(s) provided for saving.']);
    }
}
