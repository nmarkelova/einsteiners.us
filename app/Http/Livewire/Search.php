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
    public $events, $activities;
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

        //$searchinput = '%' . $this->searchEvents . '%';
        //$this->events = Event::all();
        //$this->activities = Activitie::all();
        //$this->events = DB::table('events')->where('name', 'like', $this->searchEvents )->get();
        //$this->activities = DB::table('activities')->where('name', 'like', $this->searchEvents )->get();
        $this->events = Event::where('name', 'like', '%' . $this->searchEvents . '%')->get();
        $this->activities = Activitie::where('name', 'like', '%' . $this->searchEvents . '%')->get();
        /*
        $this->events = Event::whereHas('comments', function($q)
        {
            $q->where('name', 'like', $this->searchEvents);

        })->get();

        $this->activities = Activitie::whereHas('comments', function($q)
        {
            $q->where('name', 'like', $this->searchEvents);

        })->get();
        */
        $this->searchResult = true;
    }

}
