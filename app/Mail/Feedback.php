<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Feedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        /*
        return $this->from('info@einsteiners.us', 'Einsteiners Service')
        ->subject('Booking ' + $this->select_calendars->name)
        ->view('emails.orders.shipped')->with([
            'orderTitle' => $this->select_calendars->name,
            'orderName' => $this->$personal,
            'orderPhone' => $this->$phone,
            'orderLiability' => $this->$liability,
            'orderScreening' => $this->$screening,
            'orderWaiver' => $this->$waiver,
            'orderRelease' => $this->$release,
        ]);
        */
        return $this->from('info@einsteiners.us', 'Einsteiners Service')->markdown('emails.feedback')->with($this->params);
    }
}
