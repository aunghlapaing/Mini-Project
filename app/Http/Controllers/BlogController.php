<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function master(){
        return view('Layouts/master');
    }

    public function list (){
        return view('main/list');
    }
}
