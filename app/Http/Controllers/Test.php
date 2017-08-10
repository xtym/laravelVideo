<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    public function index(){

        $data = \App::environment();
        // dd($data);
        dd(route('welcome'));
    }
}
