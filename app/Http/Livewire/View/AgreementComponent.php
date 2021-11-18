<?php

namespace App\Http\Livewire\View;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use App\Models\Agreement;

class AgreementComponent extends Component
{
    public $agreements;

    public function render()
    {
        $this->agreements = Agreement::all();
        return view('livewire.calendar.agreement', [
            'Agreements' => Agreement::all(),
        ]);
    }
}
