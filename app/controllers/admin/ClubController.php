<?php

class ClubController extends BaseController {

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
    public function clubview(){
        $clubs=Club::orderBy('sn')->get();
        return View::make('admin.club')->with('clubs',$clubs);
    }
    public function clubwrite(){
        $add=Input::get('add');
        if(isset($add)) {
            $max=Input::get('max');
            if(Input::get('name')!='' && Input::get('teacher')!='' && Input::get('place')!='' && $max!='' && is_numeric($max)){
                $club=new Club;
                $club->name=Input::get('name');
                $club->teacher=Input::get('teacher');
                $club->place=Input::get('place');
                $club->place_rain=Input::get('place_rain');
                $club->max=Input::get('max');
                $club->save();
                return Redirect::to('admin.club')->with('write','1');
            }
            else{
                return Redirect::to('admin.club');
            }
        }
        else {
            $clubs = Club::all();
            for ($i = 0; $i < count($clubs); $i++) {
                $club = Club::find($clubs[$i]->id);
                $club->sn = Input::get('sn' . $clubs[$i]->id);
                $club->name = Input::get('name' . $clubs[$i]->id);
                $club->teacher = Input::get('teacher' . $clubs[$i]->id);
                $club->place = Input::get('place' . $clubs[$i]->id);
                $club->place_rain = Input::get('place_rain' . $clubs[$i]->id);
                $club->max = Input::get('max' . $clubs[$i]->id);
                $club->save();
            }
            return Redirect::to('admin.club')->with('write', '2');
        }
    }
    public function clubdel($id){
        $club=Club::find($id);
        $club->delete();
        return Redirect::to('admin.club')->with('write','3');
    }

    public function clubsort($uid,$did){
        $club1=Club::where('sn','=',$uid)->first();
        $club2=Club::where('sn','=',$did)->first();
        $club2->sn=$uid;
        $club2->save();
        $club1->sn=$did;
        $club1->save();
        return Redirect::to('admin.club')->with('write', '4');
    }


}
