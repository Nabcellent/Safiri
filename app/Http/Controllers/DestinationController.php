<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestinationController extends Controller
{
    /**
     * @return Response|RedirectResponse
     */
    public function index(): Response|RedirectResponse {
        try {
            $data = [
                'categories' => Category::select(['id', 'title'])->get(),
                'vicinities' => Destination::select(['id', 'vicinity'])->distinct()->take(10)->get()
                    ->reject(function($vicinity) {
                        return strlen($vicinity->vicinity) > 30;
                    }),
                'minPrice' => ceil(Destination::min('price')),
                'maxPrice' => floor(Destination::max('price')),
            ];

            return response()->view('destinations', $data);
        } catch (Exception $e) {
//            dd($e->getMessage());
            return failNotFound();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function show(int $id): Response|RedirectResponse {
        try {
            $data = [
                'destination'           => Destination::with(['destinationImages', 'category'])->findOrFail($id),
                "suggestedDestinations" => Destination::inRandomOrder()->take(7)->get(),
            ];

            return response()->view('details', $data);
        } catch (Exception) {
            return failNotFound();
        }
    }

    public function filter(Request $request) {
        $data = $request->all();
        $data['perPage'] = 10;

//        $priceString = 'destinations.price - (destinations.price * (destinations.discount / 100))';
        $priceString = 'destinations.price';
        $query = Destination::with('category')->where('destinations.status', true)
            ->whereRaw("$priceString >= {$data['priceRange'][0]}")->whereRaw("$priceString <= {$data['priceRange'][1]}")
            ->join('categories', 'destinations.category_id', 'categories.id')->select('destinations.*');

        if(isset($data['category'])) {
            $query->whereIn('categories.id', $data['category']);
        }
        if(isset($data['vicinity'])) {
            $query->whereIn('destinations.id', $data['vicinity']);
        }

        if(isset($data['sort']) && !empty($data['sort'])) {
            if($data['sort'] === "newest") {
                $query->orderByDesc('destinations.id');
            } else if($data['sort'] === "oldest") {
                $query->orderBy('destinations.id');
            } else if($data['sort'] === "price_asc") {
                $query->orderByRaw($priceString);
            } else if($data['sort'] === "price_desc") {
                $query->orderByRaw("$priceString DESC");
            }
        }

        $destinations = $query->paginate($data['perPage']);

        return [
            'view'  => (string)view('partials.listing', compact('destinations')),
            'count' => count($destinations)
        ];
    }

}
