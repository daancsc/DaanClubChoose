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
            <form class="ui large form" method="post" action="./admin.deal">
                <h2 class="ui blue image header">
                    <div class="content">
                        確定開始自動分發?
                    </div>
                </h2>
                <div class="content">
                    <button class="ui large submit button positive" type="submit" name="all">開始自動分發</button>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="ui checkbox">
                    <input type="checkbox" onchange="dis()">
                    <label>隨機分發</label>
                </div>
                <br>
                <h2 class="ui blue image header disabled" id="txtran">
                    <div class="content">
                        把未選課或未分發上的學生隨機分組？
                    </div>
                </h2>
                <div class="content">
                    <button class="ui large positive submit button disabled" type="submit" name="random" id="btnran">開始隨機分發</button>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </form>
            <script>
                var view=false;
                function dis(){
                    if(!view){
                        $("#btnran").removeClass("disabled");
                        $("#txtran").removeClass("disabled");
                        view=true;
                    }
                    else{
                        $("#btnran").addClass("disabled");
                        $("#txtran").addClass("disabled");
                        view=false;
                    }
                }
            </script>
        </div>
    </div>
@endsection