<?php

namespace App\Http\Livewire\View;

use Illuminate\Support\Facades\App;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Activitie;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class CalendarlistComponent extends Component
{
    use Notifiable;
    use WithPagination;
    use WithFileUploads;

    public $user, $select_calendars, $calendars, $name, $age, $date_event, $description, $location, $cover_path, $cover_add;

    public $personal, $phone;

    public $adminView = false;
    public $selected_id = null;
    public $confirmEvent = false;
    public $updateMode = false;
    public $createMode = false;
    public $previewMode = false;
    public $previewAddMode = false;
    public $upgradeUpload = false;
    public $closeModal = false;
    public $callbackModal = false;

    public function render()
    {
        $user = Auth::user();

        //dd($user);

        if (isset($user)) {
            if($user['role_id'] == '3') {
                $this->adminView = true;
            } else {
                $this->adminView = false;
            }
        } else {
            $this->adminView = false; 
        }

        $this->calendars = Calendar::all();
        //$this->calendars = Calendar::where('active', '1')->get()->take(20);
        return view('livewire.calendar.list');
    }

    public function store()
    {
        $user = Auth::user();
        $this->validate([
            'name' => 'required|min:5',
            'cover_add' => 'required|image|max:1024',
            'age' => 'required|min:1',
            'location' => 'required|min:5',
            'date_event' => 'required',
            'description' => 'required|min:50',
        ]);

        Calendar::create([
            'name' => $this->name,
            'cover_path' => $this->cover_add->store('upload/calendar', 'public'),
            'date_event' => $this->date_event,
            'age' => $this->age,
            'location' => $this->location,
            'description' => $this->description,
        ]);
        $this->resetInput();
        $this->createMode = false;
        $this->previewAddMode = false;
        $this->closeModal = 'crevent';

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие добавлено');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event added');
        }
        
    }

    public function callbackModal($id) {
        $this->select_calendars = Calendar::find($id);
        $this->callbackModal = true;
    }

    public function routeNotificationForMail($notification)
    {
        return 'info@einsteiners.net';
    }

    public function sand($id) {
        $this->select_calendars = Calendar::find($id);
        $this->callbackModal = false;
        /*
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->from('info@einsteiners.net', 'Einsteiners Service')
                ->greeting('Hello! Einsteiners.net')
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
        */
        return (new MailMessage)
                ->from('info@einsteiners.net', 'Einsteiners Service')
                ->greeting($this->elect_calendars->name)
                ->subject($this->elect_calendars->name)
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
    }

    public function update()
    {    
        if ($this->upgradeUpload) {
            $this->validate([
                'selected_id' => 'required|numeric',
                'name' => 'required|min:5',
                'cover_path' => 'required|image|max:1024',
                'age' => 'required|min:1',
                'location' => 'required|min:5',
                'date_event' => 'required', /*date_format:d.m.Y H:i 12.12.1212 12:00*/
                'description' => 'required|min:50',
            ]);
            if ($this->selected_id) {
                $calendars = Calendar::find($this->selected_id);
                $calendars->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    'cover_path' => $this->cover_path->store('upload/event', 'public'),
                    'date_event' => $this->date_event,
                    'age' => $this->age,
                    'location' => $this->location,
                    'description' => $this->description,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                $this->closeModal = 'editevent';

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
                'age' => 'required|min:1',
                'location' => 'required|min:5',
                'date_event' => 'required', /*date_format:d.m.Y H:i 12.12.1212 12:00*/
                'description' => 'required|min:50',
            ]);
            if ($this->selected_id) {
                $calendars = Calendar::find($this->selected_id);
                $calendars->update([
                    'id' => $this->selected_id,
                    'name' => $this->name,
                    //'cover_path' => $this->cover_path->store('upload', 'public'),
                    'date_event' => $this->date_event,
                    'age' => $this->age,
                    'location' => $this->location,
                    'description' => $this->description,
                ]);
                $this->resetInput();
                $this->addMode = false;
                $this->updateMode = false;
                $this->closeModal = 'editevent';

                if (App::isLocale('ru')) {
                    session()->flash('message', 'Изменения сохранены');
                } elseif (App::isLocale('en')) {
                    session()->flash('message', 'Changes saved');
                }
            }
        }
        
    }

    public function delete($id)
    {
        if ($id) {
            $calendars = Calendar::where('id', $id);  
            $image = DB::table('calendars')->where('id', $id)->first();
            $this->confirmEvent = false;
            sleep(1);
            Storage::disk('public')->delete($image->cover_path);
            $calendars->delete();
        }

        if (App::isLocale('ru')) {
            session()->flash('message', 'Событие удаленно');
        } elseif (App::isLocale('en')) {
            session()->flash('message', 'Event deleted');
        }
    }

    private function resetInput()
    {
        $this->name = null;
        $this->cover_path = null;
        $this->age = null;
        $this->location = null;
        $this->date_event = null;
        $this->description = null;
        $this->selected_id = null;
    }

    public function create()
    {
        $this->selected_id = null;
        $this->updateMode = false;
        $this->createMode = true;
        $this->resetInput();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->confirmEvent = false;
        $calendars = Calendar::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $calendars->name;
        $this->cover_path = $calendars->cover_path;
        $this->age = $calendars->age;
        $this->location = $calendars->location;
        $this->date_event = $calendars->date_event;
        $this->description = $calendars->description;
        $this->resetValidation();
    }

    public function deleteConfirm($id)
    {
        $this->updateMode = false;
        $this->confirmEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function deactiveConfirm($id)
    {
        $this->updateMode = false;
        $this->deactiveEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function activeConfirm($id)
    {
        $this->updateMode = false;
        $this->activeEvent = $id;
        $this->updateMode = false;
        $this->createMode = false;
    }

    public function updatedCoverAdd()
    {
        $this->validate([
            'cover_add' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->updateMode = false;
        $this->previewAddMode = $this->cover_add->store('upload/calendar', 'public');
    }

    public function updatedCoverPath()
    {
        $this->validate([
            'cover_path' => 'required|image|max:1024', // 1MB Max
        ]);
        $this->previewMode = $this->cover_path->store('upload/calendar', 'public');
        $this->upgradeUpload = true;
    }

}