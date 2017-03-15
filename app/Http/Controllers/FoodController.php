<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Food;
use App\Location;
use App\User;

class FoodController extends Controller {
    
    public function index() {
        $foods = Food::with('user')->get();
        return $foods;
    }
    
}
