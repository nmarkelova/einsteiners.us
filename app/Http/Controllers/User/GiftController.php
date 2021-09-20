<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return '1';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return '1';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gift = new Gift();
        $gift->name = $request->name;
        $path = $request->file('image')->store('upload', 'public');
        $gift->cover_path = $path;
        $gift->description = $request->description;
        $gift->link_market = $request->link_market;
        $gift->user_id = $request->user_id;
        $gift->event_id = $request->event_id;
        $gift->save();
        return redirect(route('event.index'))->withSuccess('Gift Adds');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function show(Gift $gift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function edit(Gift $gift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gift $gift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gift $gift)
    {
        $gift->delete();
        return redirect()->back()->withSuccess('Delete Gift');
    }
}
