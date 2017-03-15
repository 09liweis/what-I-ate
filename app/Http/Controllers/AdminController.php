<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Food;
use App\Location;
use App\User;

class AdminController extends Controller
{
    //
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dashboard() {
        return view('dashboard');
    }
    
    //list of Foods
    public function index() {
        $currentUserId = Auth::user()->id;
        
        return Auth::user()->foods()->orderBy('created_at', 'desc') ->get();
    }
    
    public function api() {
        return Food::with('user')->get();
    }
    
    public function detail($id) {
        $food = Food::findOrFail($id);
        $location = $food->location;
        $food->location = $location;
        return $food;
    }
    
    public function create(Request $request) {
        
        
        // $food = new Food([
        //     'name' => $request->food['name'],
        //     'photo_url' => $request->food['photo_url'],
        //     'price' => $request->food['price'],
        //     'rating' => $request->food['rating'],
        // ]);
        $food = new Food();
        $this->createOrUpdate($food, $request);
    }
    
    public function update(Request $request, $id) {
        $food = Food::findOrFail($id);
        $this->createOrUpdate($food, $request);
    }
    
    public function delete($id) {
        Food::destroy($id);
    }
    
    public function createOrUpdate($food, $request) {
        $food->name = $request->food['name'];
        $food->photo_url = $request->food['photo_url'];
        $food->price = $request->food['price'];
        $food->rating = $request->food['rating'];
        
        Auth::user()->foods()->save($food);
        
        $food->save();
        $location = Location::where('google_place_id', $request->location['google_place_id'])->first();

        if (!$location) {
            $location = new Location();
            $location->name = $request->location['name'];
            $location->address = $request->location['address'];
            $location->lat = $request->location['lat'];
            $location->lng = $request->location['lng'];
            $location->photo_url = $request->location['photo_url'];
            $location->google_place_id = $request->location['google_place_id'];
            $location->save();
        }
        $food->location()->associate($location);
        $food->save();
    }
}
