<?php

class AccountController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
    public function login(){
        $account = Input::get('account');
        $password = Input::get('password');
        if (Auth::attempt(array('account' => $account, 'password' => $password))) {
            return Redirect::to('admin');
        }
        else{
            return Redirect::to('admin');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }


}
