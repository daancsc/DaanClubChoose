<?php

class ResultController extends BaseController {

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
    public function resultview(){
        $clubs=Club::orderBy('sn')->get();
        $classstu=Student::distinct()->lists('class');
        return View::make('admin.result')->with('clubs',$clubs)->with('class',$classstu);
    }
    public function resultfind($sort,$id){
        switch($sort) {
            case 'class':
                $class=Student::where('class','=',$id)->get();
                for($i=0;$i<count($class);$i++) {
                    if(Club::where('id','=',Choose::where('stu_id','=',$class[$i]->id)->first()->result)->count()>0&&Choose::where('stu_id','=',$class[$i]->id)->first()->result!=null)
                        $result[]=Club::find(Choose::where('stu_id','=',$class[$i]->id)->first()->result)->name;
                    else
                        $result[]='無';
                }
                return Redirect::to('admin.result')->with('result',$class)->with('name',$id)->with('wish',$result);
                break;
            case 'club':
                $clubchoose=Choose::where('result','=',$id)->orderBy('stu_id')->get();
                for($i=0;$i<count($clubchoose);$i++) {
                    $stuchoose[]=Student::find($clubchoose[$i]->stu_id);
                }
                $name=Club::find($id)->name;
                if(!isset($stuchoose)){
                    return Redirect::to('admin.result')->with('name',$name);
                }
                else{
                    return Redirect::to('admin.result')->with('result',$stuchoose)->with('name',$name);
                }
                break;
        }
    }

    public function noresultview(){
        $students=Student::all();
        for($i=0;$i<count($students);$i++){
            if(Choose::where('stu_id','=',$students[$i]->id)->count()==0){
                $noresult[]=$students[$i];
                $because[]='未選課';
            }
            else{
                if(Choose::where('stu_id','=',$students[$i]->id)->first()->result==null){
                    $noresult[]=$students[$i];
                    $because[]='未分發上';
                }
                else if(Club::where('id','=',Choose::where('stu_id','=',$students[$i]->id)->first()->result)->count()==0){
                    $noresult[]=$students[$i];
                    $because[]='原錄取課程被刪除';
                }
            }
        }
        if(isset($noresult)){
            return View::make('admin.noresult')->with('noresult',$noresult)->with('because',$because);
        }
        else{
            return View::make('admin.noresult');
        }

    }


}
