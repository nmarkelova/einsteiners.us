<?php

namespace App\Http\Livewire\View;

use Livewire\Component;
use App\Models\Citie;

class CitieComponent extends Component
{
    public $variable;
    public $namecitie;

    public function render()
    {
        $names = Citie::where('id', $this->variable)->get();
        foreach($names as $name) {
            $this->namecitie = $name->name;
        };
        return <<<'blade'
            <i>
                {{ __($namecitie) }}
            </i>
        blade;
    }
}
