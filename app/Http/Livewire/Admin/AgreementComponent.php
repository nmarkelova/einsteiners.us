<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Agreement;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AgreementComponent extends Component
{
    use WithFileUploads;
    public $agreements, $name, $cover_path;

    public function render()
    {
        $this->agreements = Agreement::all();
        return view('livewire.admin.agreement', [
            'Agreements' => Agreement::all(),
        ]);
    }
}
