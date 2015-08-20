@extends('admin.layout')

@section('main')
    <div class="ui middle aligned center aligned grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <div class="column eight wide">
            @if(Session::get('write')==9)
                <div class="ui info message">
                    自動分發成功
                </div>
            @elseif(Session::get('write')==10)
                <div class="ui info message">
                    隨機分發成功
                </div>
            @else
                <br>
                <br>
                <br>
            @endif
            <br>
            <br>
            <form class="ui large form" method="post" action="./admin.doc">
                <h2 class="ui blue image header">
                    <div class="content">
                        各班級簽名確認
                    </div>
                </h2>
                <div class="content">
                    <button class="ui large submit button positive" type="submit" name="class">各班級簽名確認</button>
                </div>
                <br>
                <br>
                <br>
                <br>
                <h2 class="ui blue image header">
                    <div class="content">
                        各綜合活動點名表
                    </div>
                </h2>
                <div class="content">
                    <button class="ui large positive submit button" type="submit" name="clubs">各綜合活動點名表</button>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
        </div>
    </div>
@endsection