<?php

namespace App\Http\Livewire\View;

use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartnerComponent extends Component
{
    use WithFileUploads;

    public $partners, $user, $name, $cover_path;
    public $cover_add;
    public $selected_id = null;
    public $confirmEvent = false;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $upgradeUpload = false;
    public $adminView = false;

    public function render()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $this->partners = Partner::all();
            if ($user->role_id == '3') {
                $this->adminView = true;
                return view('livewire.partner.home');
            } else {
                return view('livewire.partner.home');
            }
        } else {
            $this->partners = Partner::all();
            return view('livewire.partner.home');
        }
        
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:5',
            'cover_add' => 'required|image|max:1024',
        ]);

        Partner::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/partner', 'public'),
        ]);
        $this->resetInput();
        $this->createMode = false;
        $this->previewAddMode = false;

        if (App::isLocale('ru')) {
            session()->flash('message', 'Партнер добавлен');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Partner added');
        }
        
    }

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function updatedCoverAdd()
    {
        $this->validate([
            'cover_add' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->updateMode = false;
        $this->previewAddMode = $this->cover_add->store('upload/partner', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/partner', 'public');
        $this->upgradeUpload = true;
    }

    public function update()
    {    
        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                'cover_path' => 'required|image|max:1024',
            ]);
            if ($this->selected_id) {
                $partner = Partner::find($this->selected_id);
                $partner->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/partner', 'public'),
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        } else {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                //'cover_path' => 'required|image|max:1024',
            ]);
            if ($this->selected_id) {
                $partner = Partner::find($this->selected_id);
                $partner->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        }
        
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->confirmEvent = false;
        $partner = Partner::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $partner->name;
        $this->cover_path = $partner->cover_path;
        $this->resetValidation();
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function delete($id)
    {
        if ($id) {
            $partner = Partner::where('id', $id);  
            $image = DB::table('partners')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            //Storage::disk('public')->delete($image->cover_path);
            $partner->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Партнер удален');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Partner deleted');
        }
    }

}
