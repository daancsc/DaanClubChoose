<?php

class AdminController extends BaseController {

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

	public function settingview(){
        $status = Settings::where('item', 'status')->first();
        $resultview=Settings::where('item', 'resultview')->first();
        $resultchange=Settings::where('item', 'resultchange')->first();
        $chooseMin=Settings::where('item', 'chooseMin')->first();
        $home_post=Settings::where('item', 'home_post')->first();
        $post_important=Settings::where('item', 'post_important')->first();
        $noresultchange=Settings::where('item', 'noresultchange')->first();
        $resulttitle=Settings::where('item', 'resulttitle')->first();
        return View::make('admin.setting')->with('status',$status)->with('resultview',$resultview)->with('resultchange',$resultchange)->with('choosemin',$chooseMin)->with('home_post',$home_post)->with('post_important',$post_important)->with('noresultchange',$noresultchange)->with('resulttitle',$resulttitle);
	}

    public function settingwrite(){
        $status = Input::get('status');
        $resultview=Input::get('resultview');
        $resultchange=Input::get('resultchange');
        $chooseMin=Input::get('choosemin');
        $home_post=Input::get('home_post');
        $post_important=Input::get('post_important');
        $noresultchange=Input::get('noresultchange');
        $resulttitle=Input::get('resulttitle');

        $status1 = Settings::where('item', 'status')->first();
        $status1->value=(isset($status)?'1':'0');
        $status1->save();
        $resultview1=Settings::where('item', 'resultview')->first();
        $resultview1->value=(isset($resultview)?'1':'0');
        $resultview1->save();
        $resultchange1=Settings::where('item', 'resultchange')->first();
        $resultchange1->value=(isset($resultchange)?'1':'0');
        $resultchange1->save();
        $chooseMin1=Settings::where('item', 'chooseMin')->first();
        $chooseMin1->value=$chooseMin;
        $chooseMin1->save();
        $home_post1=Settings::where('item', 'home_post')->first();
        $home_post1->value=$home_post;
        $home_post1->save();
        $post_important1=Settings::where('item', 'post_important')->first();
        $post_important1->value=$post_important;
        $post_important1->save();
        $noresultchange1=Settings::where('item', 'noresultchange')->first();
        $noresultchange1->value=(isset($noresultchange)?'1':'0');
        $noresultchange1->save();
        $resulttitle1=Settings::where('item', 'resulttitle')->first();
        $resulttitle1->value=$resulttitle;
        $resulttitle1->save();

        return Redirect::to('admin.setting')->with('write','2');
    }
    public function clubview(){
        $clubs=Club::orderBy('sn')->get();
        return View::make('admin.club')->with('clubs',$clubs);
    }
    public function clubwrite(){
        $add=Input::get('add');
        if(isset($add)) {
            $max=Input::get('max');
            if(Input::get('name')!='' && Input::get('teacher')!='' && Input::get('place')!='' && $max!='' && is_numeric($max))
            $club=new Club;
            $club->name=Input::get('name');
            $club->teacher=Input::get('teacher');
            $club->place=Input::get('place');
            $club->place_rain=Input::get('place_rain');
            $club->max=Input::get('max');
            $club->save();
            return Redirect::to('admin.club')->with('write','1');
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
                    if(Choose::where('stu_id','=',$class[$i]->id)->first()->result!=null && Club::where('id','=',Choose::where('stu_id','=',$class[$i]->id)->first()->result)->count()>0)
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

    public function reset(){
        return View::make('admin.reset');
    }

    public function resetwrite(){
        $uploadstu=Input::get('uploadstu');
        $uploadclub=Input::get('uploadclub');
        $clear=Input::get('clear');
        $complexstu=Input::get('complexstu');
        $clearresult=Input::get('clearresult');
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
                        case "班級":
                            $kind[$x]="class";
                            break;
                        case "學號":
                            $kind[$x]="account";
                            break;
                        case "座號":
                            $kind[$x]="seat";
                            break;
                        case "學生姓名":
                            $kind[$x]="name";
                            break;
                        case '身份證':
                            $kind[$x]="password";
                            break;
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
                        case "編號":
                            $kind[$x]="sn";
                            break;
                        case "課程名稱":
                            $kind[$x]="name";
                            break;
                        case "授課教師":
                            $kind[$x]="teacher";
                            break;
                        case "上課地點":
                            $kind[$x]="place";
                            break;
                        case '雨備地點':
                            $kind[$x]="place_rain";
                            break;
                        case '名額限制':
                            $kind[$x]="max";
                            break;
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
        }
    }

    public function doc(){
        return View::make('admin.doc');
    }

    public function docmake(){
        $class=Input::get('class');
        $clubs=Input::get('clubs');
        if(isset($clubs)){

            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $clubs=Club::orderBy('sn')->get();
            for($i=0;$i<count($clubs);$i++){

                $id=$clubs[$i]->id;
                $clubchoose=Choose::where('result','=',$id)->orderBy('stu_id')->get();
                $stuchoose="";
                for($y=0;$y<count($clubchoose);$y++) {
                    $stuchoose[]=Student::find($clubchoose[$y]->stu_id);
                }

                $section = $phpWord->addSection(array( 'marginTop' => "1815",'marginLeft' => "1800",'marginRight' => "1415",'marginBottom' => "990"));

                $header = $section->addHeader();
                $header->firstPage();
                $header->addText('◎任課老師請務必簽名。學生缺曠記錄如有更動，請老師簽名在旁，以確認是老師所更動。',
                    array('name'=>'新細明體', 'size'=>10.5));
                $header->addText('◎缺課請在格內劃X，遲到劃⊗並於劃記旁簽名，早退劃△。',
                    array('name'=>'新細明體', 'size'=>10.5));

                $year=(int)date("Y")-1911;
                $footer=$section->addFooter();
                $footer->firstPage();
                $footer->addText('日期：'.$year.date("年m月d日").'       任課老師簽名：_____________',
                    array('name'=>'新細明體', 'size'=>16,'color'=>'FF0000','bold'=>true));
                $footer->addTextBreak(2,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));


                $section->addText(($i+1).'.'.$clubs[$i]->name.' - '.$clubs[$i]->teacher.'老師',
                    array('name'=>'新細明體', 'size'=>12,'color'=>'000000','bold'=>true),array('align'=>'center'));

                $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 40,'align'=>'center');
                $styleCell = array('valign' => 'center');
                $fontStyle = array('name'=>'新細明體', 'size'=>12,'color'=>'000000');
                $phpWord->addTableStyle('Fancy Table', $styleTable);
                $table = $section->addTable('Fancy Table');
                $table->addRow(100);
                $table->addCell(750,$styleCell)->addText('編號',$fontStyle,array('align'=>'center'));
                $table->addCell(1200,$styleCell)->addText('班級',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('學號',$fontStyle,array('align'=>'center'));
                $table->addCell(750,$styleCell)->addText('座號',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('姓名',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('第六節',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('第七節',$fontStyle,array('align'=>'center'));
                for ($r = 0; $r < count($stuchoose); $r++) {
                    $table->addRow(100);
                    $table->addCell(1750,$styleCell)->addText($r+1,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($stuchoose[$r]->class,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($stuchoose[$r]->account,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($stuchoose[$r]->seat,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($stuchoose[$r]->name,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell);
                    $table->addCell(1750,$styleCell);
                }
            }

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('tmp/點名單.docx');

            header('Content-type:  application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename= "點名單.docx"');
            readfile('tmp/點名單.docx');
            return Redirect::to('./admin.doc');
        }else if(isset($class)){
            $phpWord = new \PhpOffice\PhpWord\PhpWord();

            $classes=Student::distinct()->lists('class');
            for($y=0;$y<count($classes);$y++){
                $id=$classes[$y];
                $class=Student::where('class','=',$id)->get();
                $result="";
                for($i=0;$i<count($class);$i++) {
                    if(Choose::where('stu_id','=',$class[$i]->id)->first()->result!=null && Club::where('id','=',Choose::where('stu_id','=',$class[$i]->id)->first()->result)->count()>0)
                        $result[]=Club::find(Choose::where('stu_id','=',$class[$i]->id)->first()->result);
                    else
                        $result[]='無';
                }

                $section = $phpWord->addSection();
                if($y==0){
                    $section->addText('各班級簽名確認表',
                        array('name'=>'新細明體', 'size'=>18,'color'=>'000000','bold'=>true,'italic'=>true),array('align'=>'center'));
                } else{
                    $section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
                }

                $section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
                $section->addText($id,
                    array('name'=>'新細明體', 'size'=>12,'color'=>'000000','bold'=>true),array('align'=>'center'));
                $section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));

                $styleTable = array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 40,'align'=>'center');
                $styleCell = array('valign' => 'center');
                $fontStyle = array('name'=>'新細明體', 'size'=>12,'color'=>'000000');
                $phpWord->addTableStyle('Fancy Table', $styleTable);
                $table = $section->addTable('Fancy Table');
                $table->addRow(100);
                $table->addCell(1100,$styleCell)->addText('學號',$fontStyle,array('align'=>'center'));
                $table->addCell(750,$styleCell)->addText('座號',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('姓名',$fontStyle,array('align'=>'center'));
                $table->addCell(3000,$styleCell)->addText('分發結果',$fontStyle,array('align'=>'center'));
                $table->addCell(2000,$styleCell)->addText('請簽名確認',$fontStyle,array('align'=>'center'));
                for ($r = 0; $r < count($class); $r++) {
                    $table->addRow(100);
                    $table->addCell(1750,$styleCell)->addText($class[$r]->account,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($class[$r]->seat,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($class[$r]->name,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell)->addText($result[$r]->name,$fontStyle,array('align'=>'center'));
                    $table->addCell(1750,$styleCell);
                }
            }



            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('tmp/簽名確認單.docx');

            header('Content-type:  application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename= "簽名確認單.docx"');
            readfile('tmp/簽名確認單.docx');
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }



}
