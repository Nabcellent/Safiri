<?php

return [
    'places' => [
        'key' => env('GOOGLE_PLACES_API_KEY', null),
        'base_url' => "https://maps.googleapis.com/maps/api/place/",
        'verify_ssl' => true,
        'headers' => []
    ],
];
