<?php

class StudentController extends BaseController {

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

	public function chooselist(){
        $ifchosen=Student::find(Session::get('id'))->chosen;
        $resultview=Settings::where('item', 'resultview')->first();
        $change2=Student::find(Session::get('id'))->change2;
        if($resultview->value==1 && Session::get('change') != 2 && $change2 != 1) {
            if(Choose::where('stu_id', '=', Session::get('id'))->count()>0){
                $choose = Choose::where('stu_id', '=', Session::get('id'))->first();
                if(!is_null($choose->result)) {
                    $clubsresult = Club::where('id', '=', $choose->result)->first();
                    $resulttitle = Settings::where('item', 'resulttitle')->first();
                    $resultchange = Settings::where('item', 'resultchange')->first();
                    return View::make('lastresult')->with('result',$clubsresult)->with('title',$resulttitle->value)->with('change',$resultchange->value);
                }
                else {
                    $resulttitle = Settings::where('item', 'resulttitle')->first();
                    $noresultchange = Settings::where('item', 'noresultchange')->first();
                    return View::make('lastresult')->with('title',$resulttitle->value)->with('change',$noresultchange->value);
                }
            }
            else{
                $resulttitle = Settings::where('item', 'resulttitle')->first();
                $noresultchange = Settings::where('item', 'noresultchange')->first();
                return View::make('lastresult')->with('title',$resulttitle->value)->with('change',$noresultchange->value);
            }
        }
        else {
            if ($ifchosen == 0 || Session::get('change') == 1 && Session::get('change') != 2) {
                $change = Settings::where('item', 'resultchange')->first();
                $result = Settings::where('item', 'resultview')->first();
                $nochange = Settings::where('item', 'noresultchange')->first();
                $choosemax = Settings::where('item', 'chooseMax')->first();
                $choosemin = Settings::where('item', 'chooseMin')->first();
                $club = Club::orderBy('sn')->get();
                if (Session::get('change') == 1) {
                    $choose = Choose::where('stu_id', '=', Session::get('id'))->first();
                    for($w=0;$w<15;$w++){
                        $result[$w]=$choose->{"choose".($w+1)};
                    }
                    for ($i = 0; $i < 15; $i++) {
                        $clubschoose[$i] = Club::where('id', '=', $result[$i])->first();
                    }
                    return View::make('choose')->with('clubs', $club)->with('choosemax', $choosemax->value)->with('select', '1')->with('choosemin', $choosemin->value)->with('clubschoose', $clubschoose);
                } else {
                    return View::make('choose')->with('clubs', $club)->with('choosemax', $choosemax->value)->with('select', '1')->with('choosemin', $choosemin->value);
                }
            } else if ($ifchosen == 1 && Session::get('change') != 2) {
                $choose = Choose::where('stu_id', '=', Session::get('id'))->first();
                $choosemax = Settings::where('item', 'chooseMax')->first();
                for($w=0;$w<15;$w++){
                    $result[$w]=$choose->{"choose".($w+1)};
                }
                for ($i = 0; $i < 15; $i++) {
                    $clubschoose[$i] = Club::where('id', '=', $result[$i])->first();
                }
                $resulttitle = Settings::where('item', 'resulttitle')->first();
                return View::make('result')->with('result', $clubschoose)->with('chosen', '1')->with('title',$resulttitle->value);
            }
            else if(Session::get('change') == 2) {
                $change = Settings::where('item', 'resultchange')->first();
                $result = Settings::where('item', 'resultview')->first();
                $nochange = Settings::where('item', 'noresultchange')->first();
                $choosemax = Settings::where('item', 'chooseMax')->first();
                $choosemin = Settings::where('item', 'chooseMin')->first();
                $club = Club::whereRaw('stu_in<max')->orderBy('sn')->get();
                return View::make('choose')->with('clubs', $club)->with('choosemax', $choosemax->value)->with('select', '1')->with('choosemin', $choosemin->value)->with('change','2');
            }
        }
	}

    public function choosewrite(){
        $choose=Input::get('choose');
        $choosemin = Settings::where('item', 'chooseMin')->first();
        $change=Input::get('change');
        for($i=0;$i<count($choose);$i++) {
            if($i<$choosemin->value) {
                if ($choose[$i] == ""||$choose[$i]=="#") {
                    return Redirect::to('/student')->with('error', '1');
                }
            }
        }
        for($i=0;$i<count($choose);$i++) {
            $result[$i]=Club::where('id','=',$choose[$i])->first();
        }
        if($change==2) {
            return View::make('result')->with('result',$result)->with('change','2');
        }
        else {
            return View::make('result')->with('result',$result);
        }
    }

    public function write(){
        $choose=Input::get('choose');
        $change=Input::get('change');
        if(Choose::where('stu_id','=',Session::get('id'))->count()==0&&$change!=2) {
            $choose1=new Choose;
            $choose1->stu_id=Session::get('id');
            for($w=0;$w<15;$w++){
                $choose1->{"choose".($w+1)}=$choose[$w];
            }
            $choose1->save();
            $student=Student::where('id','=',Session::get('id'))->first();
            $student->chosen='1';
            $student->save();
            return Redirect::to('./student')->with('write','1');
        }
        else if($change==2) {
            if(Choose::where('stu_id','=',Session::get('id'))->count()!=0){
                $choose1=Choose::where('stu_id','=',Session::get('id'))->first();
            }else{
                $choose1=new Choose;
                $choose1->stu_id=Session::get('id');
            }

            if($choose1->result!=null){
                $club=Club::find($choose1->result);
                $club->stu_in=($club->stu_in-1);
                $club->save();
            }

            for($w=0;$w<15;$w++){
                $choose1->{"choose".($w+1)}=$choose[$w];
            }
            $choose1->result = NULL;
            $choose1->save();
            $student=Student::where('id','=',Session::get('id'))->first();
            $student->change2 = '1';
            $student->save();
            return Redirect::to('./student')->with('write','2');
        }
        else {
            $choose1=Choose::where('stu_id','=',Session::get('id'))->first();
            for($w=0;$w<15;$w++){
                $choose1->{"choose".($w+1)}=$choose[$w];
            }
            $choose1->save();
            return Redirect::to('./student')->with('write','2');
        }
    }


    public function logout(){
        Session::flush();
        Session::regenerate();
        return Redirect::to('/')->with('logout', '1');
    }
}
