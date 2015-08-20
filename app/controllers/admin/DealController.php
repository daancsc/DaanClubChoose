<?php

class DealController extends BaseController {

    public function dealview(){
        return View::make('admin.deal');
    }

    public function dealwrite(){
        $all=Input::get('all');
        $ran=Input::get('random');
        if(isset($all)){
            $clubs=Club::all();

            $class=Student::distinct()->lists('class');

            for($i=0;$i<count($clubs);$i++){
                $club_id[$i]=$clubs[$i]->id;
                $club_last[$i]=$clubs[$i]->max-$clubs[$i]->stu_in;
                for($y=0;$y<count($class);$y++){
                    $classstu[$i][$class[$y]]=0;
                }
            }
            if(Choose::where('result','=',null)->count()>0){
                for($i=1;$i<=15;$i++){
                    $chooses=Choose::where('result','=',null)->orderByRaw('rand()')->get();
                    foreach($chooses as $choose){
                        for($y=0;$y<count($club_id);$y++){
                            if($club_id[$y]==$choose->{"choose".$i}){
                                if($club_last[$y]>0&&$classstu[$y][$choose->student->class]<5){
                                    $choose->result=$choose->{"choose".$i};
                                    $choose->save();
                                    $student=Student::find($choose->stu_id);
                                    $student->stage=Settings::where('item','stage')->first()->value;
                                    $student->change2=0;
                                    $student->save();
                                    $club_last[$y]--;
                                    $classstu[$y][$choose->student->class]++;
                                }
                            }
                        }
                    }
                }
                $clubs=Club::all();
                for($i=0;$i<count($clubs);$i++){
                    if($clubs[$i]->id==$club_id[$i]){
                        $clubs[$i]->stu_in=$clubs[$i]->max-$club_last[$i];
                        $clubs[$i]->save();
                    }
                }
                $stage=Settings::where('item','stage')->first();
                $stage->value=($stage->value+1);
                $stage->save();

                return Redirect::to('admin.deal')->with('write','9');
            }
        }else if(isset($ran)){
            $clubavg=round(DB::table('clubs')->avg('stu_in'));
            $clubs=Club::where('stu_in','<',$clubavg)->orderBy('stu_in')->get();
            for($i=0;$i<count($clubs);$i++){
                $club_id[$i]=$clubs[$i]->id;
                $club_last[$i]=$clubs[$i]->max-$clubs[$i]->stu_in;
            }
            $students=Student::where('stage','=',0)->orderByRaw('rand()')->get();

            for($i=0;$i<count($students);$i++){
                $clubran=rand(0,count($club_id)-1);
                if($club_last[$clubran]>0){
                    $students[$i]->choose->result=$club_id[$clubran];
                    //$students[$i]->stage=Settings::where('item','stage')->first()->value;
                    $students[$i]->change2=0;
                    $students[$i]->save();
                    $students[$i]->push();
                    $club_last[$clubran]--;
                }
                else{
                    $i--;
                }
            }


            $clubs=Club::where('stu_in','<',$clubavg)->orderBy('stu_in')->get();
            for($i=0;$i<count($clubs);$i++){
                if($clubs[$i]->id==$club_id[$i]){
                    $clubs[$i]->stu_in=$clubs[$i]->max-$club_last[$i];
                    $clubs[$i]->save();
                }
            }

            return Redirect::to('admin.deal')->with('write','10');
        }
    }

}
