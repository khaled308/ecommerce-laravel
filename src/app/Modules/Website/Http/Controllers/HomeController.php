<?php

namespace App\Modules\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("website::index");
    }
}
