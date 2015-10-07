<?php

class ResetController extends BaseController {

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
    public function reset(){
        return View::make('admin.reset');
    }

    public function resetwrite(){
        $uploadstu=Input::get('uploadstu');
        $uploadclub=Input::get('uploadclub');
        $clear=Input::get('clear');
        $complexstu=Input::get('complexstu');
        $clearresult=Input::get('clearresult');
	$clubscount=Input::get('clubscount');
        if(isset($uploadstu)) {
            if (!Input::file('filestu')->isValid()||!Input::hasFile('filestu')) {
                dd("檔案上傳錯誤");
            } else{
                Input::file('filestu')->move("./tmp","student.csv");

                $delimiter = "\n";
                /*** 設定 counter 初始值 ***/
                $i = 1;
                /*** 開檔 ***/
                $fp = fopen( 'tmp/student.csv', 'r' );
                /*** 不斷 loop pointer ***/
                while ( !feof ( $fp) ) {
                    /*** 將資料讀入串流中 ***/
                    $buffer = stream_get_line( $fp, 1024, $delimiter );
                    /*** 儲存該行的值 ***/
                    $buffer=str_replace("\r","",$buffer);
                    $buffer=str_replace(" ","",$buffer);
                    $line[]=$buffer;
                    /*** 遞增 counter ***/
                    $i++;
                    /*** 清楚記憶體 ***/
                    $buffer = '';
                }

                $kind=explode(',',$line[0]);
                for($x=0;$x<count($kind);$x++){
                    switch($kind[$x]){
                        case "班級":$kind[$x]="class";break;
                        case "學號":$kind[$x]="account";break;
                        case "座號":$kind[$x]="seat";break;
                        case "學生姓名":$kind[$x]="name";break;
                        case '身份證':$kind[$x]="password";break;
                    }
                }

                DB::statement('TRUNCATE TABLE student');

                for($i=1;$i<count($line)-1;$i++){
                    $student=new Student;
                    $tmp=explode(",",$line[$i]);
                    for($y=0;$y<count($tmp);$y++){
                        if($kind[$y]=="password"){
                            if($tmp[$y]!='') $student->$kind[$y]=mb_substr($tmp[$y],mb_strlen($tmp[$y],"utf-8")-4,4,"utf-8");
                        }else{
                            if($tmp[$y]!='') $student->$kind[$y]=$tmp[$y];
                        }
                    }
                    $student->save();
                }
                unlink("tmp/student.csv");
                return Redirect::to('admin.reset')->with('write','5');
            }
        }else if(isset($uploadclub)){

            if (!Input::file('fileclub')->isValid()||!Input::hasFile('fileclub')) {
                dd("檔案上傳錯誤");
            } else{
                Input::file('fileclub')->move("./tmp","club.csv");

                $delimiter = "\n";
                /*** 設定 counter 初始值 ***/
                $i = 1;
                /*** 開檔 ***/
                $fp = fopen( 'tmp/club.csv', 'r' );
                /*** 不斷 loop pointer ***/
                while ( !feof ( $fp) ) {
                    /*** 將資料讀入串流中 ***/
                    $buffer = stream_get_line( $fp, 1024, $delimiter );
                    /*** 儲存該行的值 ***/
                    $buffer=str_replace("\r","",$buffer);
                    $buffer=str_replace(" ","",$buffer);
                    $line[]=$buffer;
                    /*** 遞增 counter ***/
                    $i++;
                    /*** 清楚記憶體 ***/
                    $buffer = '';
                }
                //編號,課程名稱,授課教師,上課地點,雨備地點,名額限制
                $kind=explode(',',$line[0]);
                for($x=0;$x<count($kind);$x++){
                    switch($kind[$x]){
                        case "編號":$kind[$x]="sn";break;
                        case "課程名稱":$kind[$x]="name";break;
                        case "授課教師":$kind[$x]="teacher";break;
                        case "上課地點":$kind[$x]="place";break;
                        case '雨備地點':$kind[$x]="place_rain";break;
                        case '名額限制':$kind[$x]="max";break;
                    }
                }

                DB::statement('TRUNCATE TABLE clubs');

                for($i=1;$i<count($line)-1;$i++){
                    $club=new Club;
                    $tmp=explode(",",$line[$i]);
                    for($y=0;$y<count($tmp);$y++){
                        if($tmp[$y]!='') $club->$kind[$y]=$tmp[$y];
                    }
                    $club->save();
                }
                unlink("tmp/club.csv");
                return Redirect::to('admin.reset')->with('write','11');
            }

        } else if(isset($clear)){
            DB::statement('TRUNCATE TABLE choose');
            $clubs=Club::all();
            for($i=0;$i<count($clubs);$i++){
                $clubs[$i]->stu_in=0;
                $clubs[$i]->save();
            }
            $students=Student::all();
            foreach($students as $student){
                $student->chosen=0;
                $student->change2=0;
                $student->forced=0;
                $student->stage=0;
                $student->save();
            }
            return Redirect::to('admin.reset')->with('write','6');
        }
        else if(isset($complexstu)){
            $students=Student::where('class','LIKE','%綜高%')->get();
            for($i=0;$i<count($students);$i++){
                $student=$students[$i];
                $temp=$student->id;
                $student->delete();
                if(Choose::where('stu_id','=',$temp)->count()>0){
                    $choose=Choose::where('stu_id','=',$temp)->first();
                    $choose->delete();
                }
            }
            return Redirect::to('admin.reset')->with('write','7');
        }
        else if(isset($clearresult)){
            $clubs=Club::all();
            foreach($clubs as $club){
                $club->stu_in=0;
                $club->save();
            }
            $chooses=Choose::all();
            foreach($chooses as $choose){
                $choose->result=null;
                $choose->save();
            }
            $students=Student::all();
            foreach($students as $student){
                $student->stage=0;
                $student->save();
            }
            return Redirect::to('admin.reset')->with('write','8');
        }else if(isset($clubscount)){
	    $clubs=Club::all();
	    foreach($clubs as $club){
	    	$club->stu_in=Choose::where('result','=',$club->id)->count();
		$club->save();
	    }
	    return Redirect::to('admin.reset')->with('write','12');
	}
    }


}
