<?php

namespace App\Http\Livewire;

use App\Models\Destination;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchDestination extends Component
{
    public string $term = "";

    public function render(): Factory|View|Application {
        $data = [
            'destinations' => empty($this->term)
                ? Destination::paginate(10)
                : Destination::search($this->term)->paginate(10),
        ];

        return view('livewire.search-destination', $data);
    }
}
