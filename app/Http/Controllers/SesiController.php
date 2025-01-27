<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesiController
{
    public function index(){
        return view('/login');
    }
}
