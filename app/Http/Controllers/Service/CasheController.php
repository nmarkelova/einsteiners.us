<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

class CasheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clean()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');
        //\Artisan::call('log:clear');

        return 'Очешенно';
    }

}
