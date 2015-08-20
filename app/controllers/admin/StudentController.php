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
    public function studentview(){
        $classstu=Student::distinct()->lists('class');
        $student=Student::distinct()->lists('name');
        //return $classstu;
        return View::make('admin.student')->with('class',$classstu)->with('student',$student);
    }
    public function studentwrite(){
        $modify=Input::get('modify');
        $add=Input::get('add');
        if(isset($modify)) {
            $students=Input::get('id');
            for ($i = 0; $i < count($students); $i++) {
                $student=Student::find($students[$i]);
                $student->account=Input::get('account'.$students[$i]);
                $student->password=Input::get('password'.$students[$i]);
                $student->name=Input::get('name'.$students[$i]);
                $student->class=Input::get('class'.$students[$i]);
                $student->seat=Input::get('seat'.$students[$i]);
                $student->save();
            }
            return Redirect::to('admin.student')->with('write', '2');
        }
        else if(isset($add)) {
            if(Input::get('waccount')!='' && Input::get('wpassword')!='' && Input::get('wname')!='') {
                $student = new Student;
                $student->account=Input::get('waccount');
                $student->password=Input::get('wpassword');
                $student->name=Input::get('wname');
                $student->class=Input::get('wclass');
                $student->seat=Input::get('wseat');
                $student->save();
                return Redirect::to('admin.student')->with('write', '1');
            }
            return Redirect::to('admin.class');
        }
        else {
            $classstu = Student::distinct()->lists('class');
            $student = Student::distinct()->lists('name');
            $sql = $temp = '';
            if (Input::get('oaccount') != '')
                $sql .= "account='" . Input::get('oaccount') . "' and ";
            if (Input::get('oname') != '#')
                $sql .= "name='" . Input::get('oname') . "' and ";
            if (Input::get('oclass') != '#')
                $sql .= "class='" . Input::get('oclass') . "' and ";
            if (Input::get('oseat') != '')
                $sql .= "seat='" . Input::get('oseat') . "' and ";
            if (Input::get('ochosen') != '#')
                $sql .= "chosen='" . Input::get('ochosen') . "' and ";
            if (Input::get('ostage') != '#')
                $sql .= "stage='" . Input::get('ostage') . "' and ";
            if (Input::get('oforced') != '#')
                $sql .= "forced='" . Input::get('oforced') . "' and ";
            if ($sql != $temp) {
                $sql = substr($sql, 0, strlen($sql) - 5);
                $result = Student::whereRaw($sql)->orderBy('id')->get();
                return Redirect::to('admin.student')->with('result', $result);
                //return $sql;
            }
            return Redirect::to('admin.student');
        }
    }
    public function studentmodify($id){
        $club = Club::orderBy('sn')->get();
        $choosemin = Settings::where('item', 'chooseMin')->first();
        $choosemax = Settings::where('item', 'chooseMax')->first();
        if(Choose::where('stu_id', '=', $id)->count()>0){
            $choose = Choose::where('stu_id', '=', $id)->first();
            for($w=0;$w<15;$w++){
                $result[$w]=$choose->{"choose".($w+1)};
            }
            for ($i = 0; $i < 15; $i++) {
                $clubschoose[$i] = Club::where('id', '=', $result[$i])->first();
            }
            return View::make('admin.choose')->with('clubs', $club)->with('choosemax', $choosemax->value)->with('select', '1')->with('choosemin', $choosemin->value)->with('clubschoose', $clubschoose)->with('id',$id);
        }else{
            return View::make('admin.choose')->with('clubs', $club)->with('choosemax', $choosemax->value)->with('select', '1')->with('choosemin', $choosemin->value)->with('id',$id);
        }

    }
    public function studentmodifywrite($id){
        $choose=Input::get('choose');
        $choose1=Choose::where('stu_id','=',$id)->first();
        for($w=0;$w<15;$w++){
            $choose1->{"choose".($w+1)}=$choose[$w];
        }
        $choose1->save();
        return Redirect::to('./admin.student')->with('write','2');
    }
    public function studentdel($id){
        $student=Student::find($id);
        $student->delete();
        $choose=Choose::where('stu_id','=',$id)->first();
        $choose->delete();
        return Redirect::to('admin.student')->with('write','3');
    }
    public function studentforced($id,$clubid=null){
        if($clubid==null) {
            $clubs = Club::orderBy('sn')->get();
            return View::make('admin.forced')->with('id', $id)->with('clubs', $clubs);
        }
        else {
            $club=Club::find($clubid);
            $club->stu_in=$club->stu_in+1;
            $club->save();
            $student=Student::find($id);
            $student->forced=1;
            $student->save();
            $choose=Choose::where('stu_id','=',$id)->count();
            if($choose>0) {
                $choose=Choose::where('stu_id','=',$id)->first();
                $choose->result=$clubid;
                $choose->save();
            }
            else {
                $choose=new Choose;
                $choose->result=$clubid;
                $choose->save();
            }
            return '<script>alert("強制錄取成功");window.close();</script>';
        }
    }


}
