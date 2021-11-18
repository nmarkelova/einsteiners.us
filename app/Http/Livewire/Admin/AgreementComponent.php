<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\App;
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
    public $cover_add;
    public $selected_id = null;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $confirmEvent = false;
    public $upgradeUpload = false;

    public function render()
    {
        $this->agreements = Agreement::all();
        return view('livewire.admin.agreement', [
            'Agreements' => Agreement::all(),
        ]);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
    }

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
            'cover_add' => 'required|max:15000',
        ]);

        Agreement::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/agreement', 'public'),
        ]);
        $this->resetInput();
        $this->createMode = false;
        $this->previewAddMode = false;

        if (App::isLocale('ru')) {
            session()->flash('message', 'Документ добавлен');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Document added');
        }   
    }

    public function update()
    {    
        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:2',
                'cover_path' => 'required|max:15000',
            ]);
            if ($this->selected_id) {
                $agreement = Agreement::find($this->selected_id);
                $agreement->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/agreement', 'public'),
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
                'name' => 'required|min:2',
                //'cover_path' => 'required|image|max:1024',
            ]);
            if ($this->selected_id) {
                $agreement = Agreement::find($this->selected_id);
                $agreement->update([
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
        $agreement = Agreement::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $agreement->name;
        $this->cover_path = $agreement->cover_path;
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
            $agreement = Agreement::where('id', $id);  
            $image = DB::table('agreements')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            //Storage::disk('public')->delete($image->cover_path);
            $agreement->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Документ удаленно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Document deleted');
        }
    }


}
