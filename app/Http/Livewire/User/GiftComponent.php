<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\App;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Gift;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GiftComponent extends Component
{
    use WithFileUploads;
    public $gifts, $name, $cover_path, $description, $link_market, $event_id, $selected_gift;
    public $cover_add;
    public $selected_id = null;
    public $updateMode = false;
    public $addMode = false;
    public $confirmGift = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $upgradeUpload = false;

    public function render()
    {
        $this->gifts = Gift::where('event_id', $this->event_id)->get();
        return view('livewire.event.gift');
    }

    private function resetInput()
    {
        $this->selected_gift = null;
        $this->name = null;
        $this->cover_path = null;
        $this->description = null;
        $this->link_market = null;
    }

    public function add()
    {
        $this->addMode = true;
        $this->confirmGift = false;
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->addMode = true;
        $gift = Gift::findOrFail($id);
        $this->selected_gift = $id;
        $this->name = $gift->name;
        $this->cover_path = $gift->cover_path;
        $this->description = $gift->description;
        $this->link_market = $gift->link_market;
        $this->confirmGift = false;
        $this->resetValidation();
    }

    public function store()
    {
        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:2',
            'cover_add' => 'required|image|max:1024',
            'description' => 'required|min:5',
            'link_market' => 'required|min:5',
        ]);
        Gift::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/gift', 'public'),
            'description' => $this->description,
            'link_market' => $this->link_market,
            'active' => '1',
            'event_id' => $this->event_id,
            'user_id' => $user->id,
        ]);
        $this->resetInput();
        $this->addMode = false;
        if (App::isLocale('ru')) {
            session()->flash('message-gift', 'Подарок добавлен');
        } elseif (App::isLocale('en')) {
            session()->flash('message-gift', 'Gift added');
        }
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmGift = $id;
    }

    public function updatedCoverAdd()
    {
        $this->validate([
            'cover_add' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewAddMode = $this->cover_add->store('upload/gift', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/gift', 'public');
        $this->upgradeUpload = true;
    }

    public function update()
    {    
        if($this->upgradeUpload) {
            $this->validate([
                'name' => 'required|min:2',
                'cover_path' => 'required|image|max:1024',
                'description' => 'required|min:5',
                'link_market' => 'required|min:5',
            ]);
            if ($this->selected_gift) {
                $event = Gift::find($this->selected_gift);
                $event->update([
                    'id' => $this->selected_gift,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/gift', 'public'),
                    'description' => $this->description,
                    'link_market' => $this->link_market,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                if (App::isLocale('ru')) {
                    session()->flash('message-gift', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message-gift', 'Changes saved');
                }
            }
        } else {
            $this->validate([
                'name' => 'required|min:5',
                //'cover_path' => 'required|image|max:1024',
                'description' => 'required|min:5',
                'link_market' => 'required|min:5',
            ]);
            if ($this->selected_gift) {
                $event = Gift::find($this->selected_gift);
                $event->update([
                    'id' => $this->selected_gift,
                    'name' => $this->name,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                    'description' => $this->description,
                    'link_market' => $this->link_market,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                if (App::isLocale('ru')) {
                    session()->flash('message-gift', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message-gift', 'Changes saved');
                }
            }
        }
        
        
    }

    public function delete($id)
    {
        if ($id) {
            $gift = Gift::where('id', $id);
            $image = DB::table('gifts')->where('id', $id)->first();
            Storage::disk('public')->delete($image->cover_path);
            $this->confirmGift = false;
            sleep(1);
            $gift->delete();
            if (App::isLocale('ru')) {
                session()->flash('message-gift', 'Подарок удален');
            } elseif (App::isLocale('en')) {
                session()->flash('message-gift', 'Gift deleted');
            }
        }
    }
}
