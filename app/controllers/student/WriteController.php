<?php

class WriteController extends BaseController {

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


    public function choosewrite(){
        $choose=Input::get('choose');
        $choosemin = Settings::where('item', 'chooseMin')->first();
        $change=Input::get('change');
        for($i=0;$i<count($choose);$i++) {
            if($i<$choosemin->value) {
                if ($choose[$i] == ""||$choose[$i]=="#") {
                    if($change!=2){
                        return Redirect::to('/student')->with('error', '1');
                    }else{
                        return Redirect::to('/student')->with('error', '1')->with('change','2');
                    }
                }
            }
        }
	$num=count($choose);
	for($i=0;$i<$num;$i++){
	    if(!is_numeric($choose[$i])){
		unset($choose[$i]);
	    }
	}
	//dd($choose);
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
            for($w=0;$w<count($choose);$w++){
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

            for($w=0;$w<count($choose);$w++){
                $choose1->{"choose".($w+1)}=$choose[$w];
            }
            $choose1->result = NULL;
            $choose1->save();
            $student=Student::where('id','=',Session::get('id'))->first();
            $student->chosen='1';
            $student->change2 = '1';
            $student->save();
            return Redirect::to('./student')->with('write','2');
        }
        else {
            $choose1=Choose::where('stu_id','=',Session::get('id'))->first();
            for($w=0;$w<count($choose);$w++){
                $choose1->{"choose".($w+1)}=$choose[$w];
            }
            $choose1->save();
            return Redirect::to('./student')->with('write','2');
        }
    }

}
