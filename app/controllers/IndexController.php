<?php

class IndexController extends BaseController {

    public function index(){
        $browser = Agent::browser();
        $version = Agent::version($browser);
        if($browser=="IE"&&$version<10){
            dd("<script>alert('請使用IE10以上瀏覽器預覽/r/n或其他瀏覽器如：chrome,firefox,opera,safari');document.location.href='https://whatbrowser.org/';</script>");
        }
        $status=Settings::where('item', 'status')->first();
        $important=Settings::where('item', 'post_important')->first();
        $post=Settings::where('item', 'home_post')->first();
        if(Session::get('studentlogin')==true)
        {
            return Redirect::to('./student');
        }
        else
        {
            return View::make('index')->with('status', $status->value)->with('important', $important->value)->with('post', $post->value);
        }
    }

    public function admin(){
        if (Auth::check())
        {
            $clubspop=Club::all()->sortByDesc('stu_in')->take(10);
            $clubcold=Club::all()->sortBy('stu_in')->take(10);
            return View::make('admin.dashtable')->with('pop',$clubspop)->with('cold',$clubcold);
        }
        else
        {
            return View::make('admin.login');
        }
    }

}
