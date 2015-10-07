<?php

class WordController extends BaseController {

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
		    if(Student::where('id','=',$clubchoose[$y]->stu_id)->count()>0)
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
                    $table->addCell(750,$styleCell)->addText($r+1,$fontStyle,array('align'=>'center'));
                    $table->addCell(1200,$styleCell)->addText($stuchoose[$r]->class,$fontStyle,array('align'=>'center'));
                    $table->addCell(1100,$styleCell)->addText($stuchoose[$r]->account,$fontStyle,array('align'=>'center'));
                    $table->addCell(750,$styleCell)->addText($stuchoose[$r]->seat,$fontStyle,array('align'=>'center'));
                    $table->addCell(1100,$styleCell)->addText($stuchoose[$r]->name,$fontStyle,array('align'=>'center'));
                    $table->addCell(1100,$styleCell);
                    $table->addCell(1100,$styleCell);
                }
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
		$section->addTextBreak(1,array('name'=>'新細明體', 'size'=>10,'color'=>'FFFFFF'));
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
                    if(Choose::where('stu_id','=',$class[$i]->id)->count()>0&&Choose::where('stu_id','=',$class[$i]->id)->first()->result!=null && Club::where('id','=',Choose::where('stu_id','=',$class[$i]->id)->first()->result)->count()>0)
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
                $table->addCell(600,$styleCell)->addText('學號',$fontStyle,array('align'=>'center'));
                $table->addCell(150,$styleCell)->addText('座號',$fontStyle,array('align'=>'center'));
                $table->addCell(1100,$styleCell)->addText('姓名',$fontStyle,array('align'=>'center'));
                $table->addCell(3000,$styleCell)->addText('分發結果',$fontStyle,array('align'=>'center'));
                $table->addCell(4000,$styleCell)->addText('上課地點',$fontStyle,array('align'=>'center'));
                $table->addCell(2000,$styleCell)->addText('請簽名確認',$fontStyle,array('align'=>'center'));
                for ($r = 0; $r < count($class); $r++) {
                    $table->addRow(100);
                    $table->addCell(600,$styleCell)->addText($class[$r]->account,$fontStyle,array('align'=>'center'));
                    $table->addCell(150,$styleCell)->addText($class[$r]->seat,$fontStyle,array('align'=>'center'));
                    $table->addCell(1100,$styleCell)->addText($class[$r]->name,$fontStyle,array('align'=>'center'));
                    $table->addCell(3000,$styleCell)->addText((isset($result[$r]->name)?$result[$r]->name:''),$fontStyle,array('align'=>'center'));
                    $table->addCell(4000,$styleCell)->addText((isset($result[$r]->place)?$result[$r]->place:''),$fontStyle,array('align'=>'center'));
		    $table->addCell(2000,$styleCell);
                }
            }



            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('tmp/簽名確認單.docx');

            header('Content-type:  application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Content-Disposition: attachment; filename= "簽名確認單.docx"');
            readfile('tmp/簽名確認單.docx');
        }
    }


}
