<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cd;
class PageController extends Controller
{
    public function contact() {
        return view('page/contact');
    }
}
