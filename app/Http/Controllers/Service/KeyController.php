<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function key()
    {
        \Artisan::call('key:generate');

        return 'Ключ сгенерирован';
    }

}
