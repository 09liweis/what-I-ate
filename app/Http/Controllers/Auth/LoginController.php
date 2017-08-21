<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function index(){
        if (Auth::attempt(Input::get())) {
            return [
                'msg'=>'success!',
                'code'=>200,
                'user'=>Auth::user(),
            ];
        }else{
            return [
                'msg'=>'error!',
                'code'=>201,
            ];
        }
    }
    public function logout(){
        return Auth::logout();
    }
    
    public function showLoginForm() {
        return view('auth.login');
    }

}
