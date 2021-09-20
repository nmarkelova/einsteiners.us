<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function link()
    {
        \Artisan::call('storage:link');

        return 'Папка Sorage символизирована';
    }

}
