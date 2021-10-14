<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Activitie;
use App\Models\User;
use App\Models\Countrie;
use App\Models\Citie;

use Livewire\Component;

class Search extends Component
{
    public $searchEvents, $searchCity;
    public $user, $events, $activities;
    public $countries, $cities, $countrie_id, $citie_id;
    public $selectedCountry = false;
    public $searchResult = false;

    public function render()
    {
        $this->countries = Countrie::all();
        return view('livewire.search');
    }

    public function selectedCountry()
    {
        $this->cities = Citie::where('countrie_id', $this->countrie_id)->get();
        $this->selectedCountry = true;
    }

    public function clean()
    {
        $this->searchEvents = null;
        $this->searchCity = null;
        $this->countrie_id = null;
        $this->citie_id = null;
        $this->selectedCountry = false;
        $this->searchResult = false;
    }

    public function search()
    {
        $this->validate([
            'searchEvents' => 'required|min:2',
        ]);

        $this->user = User::where('name', 'like', '%' . $this->searchEvents . '%')->get();
        $autor = User::where('name', 'like', '%' . $this->searchEvents . '%')->get();

        if(count($this->user) == 0) {
            $this->events = Event::where('name', 'like', '%' . $this->searchEvents . '%')->get();
            $this->activities = Activitie::where('name', 'like', '%' . $this->searchEvents . '%')->get();
        } else {
            $array_autor = (array) $autor[0];
            $result_autor = $array_autor["\x00*\x00attributes"]["id"];
            $this->events = Event::where('user_id', 'like', '%' . $result_autor . '%')->get();
            $this->activities = Activitie::where('user_id', 'like', '%' . $result_autor . '%')->get();
        }

        $this->searchResult = true;
    }

}
