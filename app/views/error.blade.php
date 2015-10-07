@extends('admin.layout')

@section('main')
    <div class="ui middle aligned center aligned grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <div class="column eight wide">
            <br>
            <br>
            <br>
            <br>
            <br>
            <h2 class="ui blue image header">
                <div class="content">
                    <i class="bug icon" style="font-size: 5em;"></i><br>
                    抱歉系統發生神奇的錯誤(bug)<br>請回上一頁重新送出<br>如問題沒有改善 請email至<br>happy369987+netmag@gmail.com
                </div>
            </h2>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
@endsection
