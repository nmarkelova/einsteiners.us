<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $gifts = DB::table('gifts')->get();
        $guests = DB::table('guests')->get();
        //$events = Event::orderBy('id', 'desc')->get();
        $events = Event::where('user_id', $user['id'])->get();
        $events = Event::orderBy('id', 'desc')->get();
        return view('event.index', [
            'user' => $user,
            'gifts' => $gifts,
            'guests' => $guests,
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $categories = DB::table('categories')->get();  
        return view('event.create', [
            'user' => $user_id,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->name;
        $path = $request->file('image')->store('upload', 'public');
        $event->cover_path = $path;
        $event->description = $request->description;
        $event->link = md5($request->user_id) . md5(date("d.m.Y"));
        $event->location = $request->location;
        $event->tags = $request->tags;
        $event->user_id = $request->user_id;
        $event->date_event = $request->date_event;
        $event->save();
        return redirect(route('event.index'))->withSuccess('сreated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    public function view($link)
    {
        $users = Auth::user();
        $gifts = DB::table('gifts')->get();
        $guests = DB::table('guests')->get();
        $view = DB::table('events')->where('link', $link)->first();
        $autor = DB::table('users')->where('id', $view->user_id)->first();
        

        DB::table('events')
        ->updateOrInsert(
            ['link' => $link],
            ['reviewed' => $view->reviewed + 1]
        );

        return view('event.show', [
            'event' => $view,
            'autor' => $autor,
            'users' => $users,
            'gifts' => $gifts,
            'guests' => $guests,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $user_id = Auth::id();
        return view('event.edit', [
            'event' => $event,
            'user' => $user_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        $event->name = $request->name;

        if($request->file('image')) {
            $path = $request->file('image')->store('upload', 'public');
            $event->cover_path = $path;
        }

        $event->description = $request->description;
        $event->location = $request->location;
        $event->tags = $request->tags;
        $event->user_id = $request->user_id;
        $event->date_event = $request->date_event;

        //$event->link = $request->link;
        $event->save();

        return redirect()->back()->withSuccess('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->withSuccess('Delete');
    }
}
