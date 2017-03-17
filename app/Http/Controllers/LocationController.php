<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Location;

class LocationController extends Controller {
    public function index($id = null) {
        if ($id == null) {
            $locations = Location::all();
            return view('location/list', array('locations' => $locations, 'scripts' => array('google')));
        } else {
            $location = Location::find($id);
            return view('location/single', array('location' => $location, 'scripts' => array('google', '/js/location.js')));
        }
    }
}
