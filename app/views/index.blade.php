@extends('layout')

@section('main')
<div class="twelve wide column" style="{{!Agent::isMobile()?'margin-top:40px;':''}}">
    @if(!$important==0)
        <div class="ui warning message">
            <div class="header">重要公告</div>
            {{$important}}
        </div>
    @endif
    @if (Agent::isMobile())
        <center><a href="#bottum" style="font-size:1.8em;">跳過說明 到登入</a></center>
        <p></p>
    @endif
    <div class="ui text" style="font-size:1.3em;">
        {{$post}}
    </div>
    <a name="bottum"></a>
</div>
<div class="four wide column" style="{{!Agent::isMobile()?'position:fixed;margin-top:40px;':''}}">
    <form class="ui form container segment" action="./login" method="post">
        <div class="ui info message">
            <div class="header">如無法登入</div>
            請試試密碼用0000登入
        </div>
        @if($status==0)
            <div class="ui warning message" style="display:inherit">
                <div class="header">系統未開放</div>
            </div>
        @endif
        @if(Session::get('error')==1)
            <div class="ui warning message" style="display:inherit">
                <div class="header">帳密錯誤</div>
            </div>
        @endif
        @if(Session::get('logout')==1)
            <div class="ui info message">
                登出成功
            </div>
        @endif

        <h4 class="ui dividing header">學生登入</h4>
        <div class="ui labeled input {{$status==0?'disabled field':''}}">
            <div class="ui label">帳號</div>
            <input type="text" placeholder="學號" name="account">
        </div>
        <p></p>
        <div class="ui labeled input {{$status==0?'disabled field':''}}">
            <div class="ui label">密碼</div>
            <input type="password" placeholder="身份證後四碼" name="password">
        </div>
        <p></p>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button class="fluid ui button blue {{$status==0?'disabled':''}}" {{$status!=0?'type="submit"':''}}>登入</button>
        <p></p>
        <a href="./tmp/class.pdf" style="font-size: 2em;">>>課程總覽<<</a>
        <p></p>
        <a href="./tmp/howto.pdf">系統使用說明</a>
        <p></p>
        <div class="ui segment">
            如無法登入請至學務處詢問
        </div>
    </form>
</div>
@endsection
