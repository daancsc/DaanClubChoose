@extends('admin.layout')

@section('main')
    <div class="ui middle aligned center aligned grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <div class="column four wide">
            <h2 class="ui blue image header">
                <div class="content">
                    登入後台
                </div>
            </h2>
            <form class="ui large form" method="post" action="./admin">
                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input name="account" placeholder="帳號" type="text">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input name="password" placeholder="密碼" type="password">
                        </div>
                    </div>
                    <button class="ui fluid large blue submit button" type="submit">登入</button>
                    <a class="ui fluid large button" href="./">回首頁</a>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="ui error message"></div>

            </form>
        </div>
    </div>
@endsection