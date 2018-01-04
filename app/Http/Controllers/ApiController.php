<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Requests;
use App\Food;
use App\Location;
use App\User;

class ApiController extends Controller
{
    
    public function users() {
        return User::all();
    }
    
    public function locations() {
        return Location::where('id', '>', '0')->orderBy('updated_at', 'DESC')->get();
    }
    
    public function location($id) {
        return Location::find($id);
    }
    
    public function upsertLocation(Request $request) {
        $google_place_id = $request->google_place_id;
        $location = Location::where('google_place_id', $google_place_id);
        if (!$location) {
            $location = new Location();
            $location->name = $request->name;
            $location->address = $request->address;
            $location->lat = $request->lat;
            $location->lng = $request->lng;
            $location->photo_url = $request->photo_url;
            $location->google_place_id = $request->google_place_id;
            if ($request->updated_at) {
                $location->updated_at = $request->updated_at;
            }
            $location->save();
        }
    }

    
    //list of Foods
    public function foods() {
        return Food::with('user')->orderBy('updated_at', 'DESC')->get();
    }
    
    public function food($id) {
        $food = Food::findOrFail($id);
        $location = $food->location;
        $food->location = $location;
        return $food;
    }
    
    public function upsertFood(Request $request) {
        $user = User::find($request->user['id']);
        $foodRequest = $request->food;
        if (!$foodRequest['id']) {
            $food = new Food();
        } else {
            $food = Food::find($foodRequest['id']);
        }
        $food->name = $foodRequest['name'];
        $food->photo_url = $foodRequest['photo_url'];
        $food->price = $foodRequest['price'];
        $food->rating = $foodRequest['rating'];
        $food->save();
        
    }
    
    public function getFromProduction() {
        DB::table('users')->delete();
        DB::table('foods')->delete();
        DB::table('locations')->delete();
        $users = json_decode(file_get_contents('http://what-i-ate.herokuapp.com/api/users'));
        $foods = json_decode(file_get_contents('http://what-i-ate.herokuapp.com/api/foods'));
        $locations = json_decode(file_get_contents('http://what-i-ate.herokuapp.com/api/locations'));
        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'password' => bcrypt('123456'),
            ]);
        }
        foreach ($locations as $location) {
            DB::table('locations')->insert([
                'id' => $location->id,
                'name' => $location->name,
                'photo_url' => $location->photo_url,
                'lat' => $location->lat,
                'lng' => $location->lng,
                'address' => $location->address,
                'google_place_id' => $location->google_place_id,
                'created_at' => $location->created_at,
                'updated_at' => $location->updated_at,
            ]);
        }
        foreach ($foods as $food) {
            DB::table('foods')->insert([
                'id' => $food->id,
                'name' => $food->name,
                'photo_url' => $food->photo_url,
                'price' => $food->price,
                'rating' => $food->rating,
                'user_id' => $food->user_id,
                'location_id' => $food->location_id,
                'created_at' => $food->created_at,
                'updated_at' => $food->updated_at,
            ]);
        }
        
        return 'success';
    }
    
}
