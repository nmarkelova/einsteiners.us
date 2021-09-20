<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Http\Livewire\LivewireCalendar;
use Illuminate\Support\Collection;
use App\Models\Calendar;

class AppointmentsCalendar extends LivewireCalendar
{

    public function events() : Collection
    {
        /*
        return collect([
            [
                'id' => 1,
                'name' => 'Breakfast',
                'cover_path' => 'upload/calendar/vWDIE5flqeNzsoqTJx8H2vzRsLzWKJcPvVrC19ns.jpg',
                'description' => 'Thus, diluted with a fair amount of empathy, rational thinking allows you to assess the importance of timely completion of a super task. Modern technologies have reached such a level that the innovative path we have chosen directly depends on the distribution of internal reserves and resources. Only the key features of the project structure are objectively considered by the relevant authorities.',
                'date_event' => '2021-08-06 13:23:44',
                'location' => 'location plase'
            ],
            [
                'id' => 2,
                'name' => 'Meeting with Pamela',
                'cover_path' => 'upload/calendar/vWDIE5flqeNzsoqTJx8H2vzRsLzWKJcPvVrC19ns.jpg',
                'description' => 'Thus, diluted with a fair amount of empathy, rational thinking allows you to assess the importance of timely completion of a super task. Modern technologies have reached such a level that the innovative path we have chosen directly depends on the distribution of internal reserves and resources. Only the key features of the project structure are objectively considered by the relevant authorities.',
                'date_event' => Carbon::tomorrow(),
                'location' => 'location plase'
            ],
            [
                'id' => 3,
                'name' => 'Meeting with Pamela',
                'cover_path' => 'upload/calendar/vWDIE5flqeNzsoqTJx8H2vzRsLzWKJcPvVrC19ns.jpg',
                'description' => 'Thus, diluted with a fair amount of empathy, rational thinking allows you to assess the importance of timely completion of a super task. Modern technologies have reached such a level that the innovative path we have chosen directly depends on the distribution of internal reserves and resources. Only the key features of the project structure are objectively considered by the relevant authorities.',
                'date_event' => Carbon::tomorrow(),
                'location' => 'location plase'
            ]
        ]);
        */
        return collect(Calendar::all());
    }
}
