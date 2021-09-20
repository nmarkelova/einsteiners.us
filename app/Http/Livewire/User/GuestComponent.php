<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;

class GuestComponent extends Component
{
    public $guests, $name, $role, $task, $email, $event_id, $selected_guest;
    public $updateMode = false;
    public $addMode = false;
    public $confirmGuest = false;

    public function render()
    {
        $this->guests = Guest::where('event_id', $this->event_id)->get();
        return view('livewire.event.guest');
    }

    private function resetInput()
    {
        $this->selected_guest = null;
        $this->name = null;
        $this->role = null;
        $this->task = null;
        $this->email = null;
    }

    public function add()
    {
        $this->addMode = true;
        $this->confirmGuest = false;
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->addMode = true;
        $guest = Guest::findOrFail($id);
        $this->selected_guest = $id;
        $this->name = $guest->name;
        $this->role = $guest->role;
        $this->task = $guest->task;
        $this->email = $guest->email;
        $this->confirmGuest = false;
    }

    public function store()
    {
        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:2',
            //'role' => 'required|min:2',
            //'task' => 'required|min:5',
            'email' => 'required|email',
        ]);
        Guest::create([
            'name' => $this->name,
            'role' => $this->role,
            'task' => $this->task,
            'email' => $this->email,
            'active' => '1',
            'event_id' => $this->event_id,
            'user_id' => $user->id,
        ]);
        $this->resetInput();
        $this->addMode = false;
        if (App::isLocale('ru')) {
            session()->flash('message-guest', 'Гость добавлен');
        } elseif (App::isLocale('en')) {
            session()->flash('message-guest', 'Guest added');
        }
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmGuest = $id;
    }

    public function update()
    {    
        $this->validate([
            'name' => 'required|min:2',
            //'role' => 'required|min:2',
            //'task' => 'required|min:5',
            'email' => 'required|email',
        ]);
        if ($this->selected_guest) {
            $event = Guest::find($this->selected_guest);
            $event->update([
                'id' => $this->selected_guest,
                'name' => $this->name,
                'role' => $this->role,
                'task' => $this->task,
                'email' => $this->email,

            ]);
            $this->resetInput();
            $this->addMode = false;
            $this->updateMode = false;
            if (App::isLocale('ru')) {
                session()->flash('message-guest', 'Изменения сохранены');
            } elseif (App::isLocale('en')) {
                session()->flash('message-guest', 'Changes saved');
            }
            
        }
    }
    
    public function delete($id)
    {
        if ($id) {
            $guest = Guest::where('id', $id);
            $this->confirmGuest = false;
            sleep(1);
            $guest->delete();
            if (App::isLocale('ru')) {
                session()->flash('message-guest', 'Гость удален');
            } elseif (App::isLocale('en')) {
                session()->flash('message-guest', 'Guest deleted');
            }
        }
    }
}
