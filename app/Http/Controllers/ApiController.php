<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Food;
use App\Location;
use App\User;

class ApiController extends Controller
{
    
    public function locations() {
        return Location::all();
    }
    
    public function location($id) {
        return Location::find($id);
    }

    
    //list of Foods
    public function foods() {
        return Food::all();
    }
    
    public function food($id) {
        $food = Food::findOrFail($id);
        $location = $food->location;
        $food->location = $location;
        return $food;
    }
    
}
