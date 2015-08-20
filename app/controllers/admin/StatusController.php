<?php

class StatusController extends BaseController {

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

    public function statusview(){
        $clubs=Club::orderBy('sn')->get();
        return View::make('admin.status')->with('clubs',$clubs);
    }
    public function statusfind($id){
        for($y=1;$y<16;$y++) {
            $student[]=$y;
            $choose = Choose::where('choose'.$y, '=', $id)->orderBy('stu_id')->get();
            for ($i = 0; $i < count($choose); $i++) {
                $student[] = Student::find($choose[$i]->stu_id);
            }
        }
        return Redirect::to('admin.status')->with('result',$student)->with('id',$id);
        //return $student;
    }


}
