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
                    抱歉系統發生神奇的錯誤<br>請回上一頁重新送出<br>如問題沒有改善 請email至yoyo930021+netmange@gmail.com
                </div>
            </h2>
        </div>
    </div>
@endsection