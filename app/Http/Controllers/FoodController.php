<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Food;
use App\Location;
use App\User;

class FoodController extends Controller {
    
    public function index($id = null) {
        if ($id != null) {
            $food = Food::find($id);
            return view('food/single', array('food' => $food, 'scripts' => array()));
        } else {
            $foods = Food::with('user')->orderBy('created_at', 'desc')->get();
            //return $foods;
            return view('food/list', array('foods' => $foods, 'scripts' => array()));   
        }
    }
    
}
