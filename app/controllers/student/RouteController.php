<?php

class RouteController extends BaseController {

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
                if(Session::get('change') == 2) goto change2;
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
                change2:
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


}
