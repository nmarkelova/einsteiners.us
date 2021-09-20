<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoaderController extends Controller {

    public function ajax(Request $request)
    {
        if($request->input('position') == 'con-consent') {
            return view('includes/consent-modal');
        } elseif($request->input('position') == 'con-cookie') {
            return view('includes/cookie-modal');
        }
    }

}
