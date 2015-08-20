<?php

class SettingController extends BaseController {

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

}
