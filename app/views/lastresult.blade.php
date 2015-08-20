@extends('layout')

@section('main')
    <div class="three wide column" style="{{!Agent::isMobile()?'position:fixed;margin-top:40px;':''}}">
        <div class="ui container segment">
            <h4 class="ui dividing header">學生</h4>
            <div class="ui divided selection list">
                <a class="item">
                    <div class="ui orange horizontal label">姓名：</div>{{{Session::get('name')}}}</a>
                <a class="item">
                    <div class="ui orange horizontal label">學號：</div>{{{Session::get('account')}}}</a>
                <a class="item">
                    <div class="ui orange horizontal label">班級：</div>{{{Session::get('class')}}}</a>
                <a class="item">
                    <div class="ui orange horizontal label">座號：</div>{{{Session::get('seat')}}}</a>
            </div>
            <a class="ui blue button fluid" href="./logout">登出</a>
        </div>
    </div>
    <div class="twelve wide column right floated" style="{{!Agent::isMobile()?'margin-top:40px;':''}}">
        <div class="ui container segment grid">
            <div class="six wide column centered">
                <table class="ui celled blue inverted table">
                    <thead>
                    <tr><th colspan="3"><h4>{{{$title}}} 分發結果</h4> </th>
                    </tr></thead><tbody>
                    <tr>
                        <td>課程名稱</td>
                        <td>{{{$result->name or '沒有錄取'}}}</td>
                    </tr>
                    <tr>
                        <td>授課教師</td>
                        <td>{{{$result->teacher or '沒有錄取'}}}</td>
                    </tr>
                    <tr>
                        <td>上課地點</td>
                        <td>{{{$result->place or '沒有錄取'}}}</td>
                    </tr>
                    <tr>
                        <td>雨備地點</td>
                        <td>{{{$result->place_rain or '沒有錄取'}}}</td>
                    </tr>
                    </tbody>
                </table>
                @if($change==1)
                    <a class="ui blue button fluid" href="./noresultchange">修改志願</a>
                @endif
                {{--功能待補--}}
            </div>
        </div>
    </div>
@endsection