<?php

class StuAccountController extends BaseController {

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
        $status = Settings::where('item', 'status')->first();
        if ($status->value == 1) {
            $account = Input::get('account');
            $password = Input::get('password');
            if (Student::where('account', '=', $account)->count() > 0) {
                $student = Student::where('account', '=', $account)->firstOrFail();
                if ($student->password == $password) {
                    Session::flush();
                    Session::regenerate();
                    Session::put('studentlogin', true);
                    Session::put('id', $student->id);
                    Session::put('account', $student->account);
                    Session::put('name', $student->name);
                    Session::put('class', $student->class);
                    Session::put('seat', $student->seat);
                    return Redirect::to('./student');
                } else {
                    return Redirect::to('/')->with('error', '1');
                }
            } else {
                return Redirect::to('/')->with('error', '1');
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function logout(){
        Session::flush();
        Session::regenerate();
        return Redirect::to('/')->with('logout', '1');
    }


}
