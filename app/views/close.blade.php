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
                    <i class="arrow down icon" style="font-size: 8em;"></i>
                    系統維護中<br>請稍後在來訪 謝謝！
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