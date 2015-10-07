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
        <form  class="ui container segment" method="post" action="./student">
            @if(Session::get('error')==1)
                <div class="ui warning message" style="display:inherit">
                    <div class="header">請填滿最少{{$choosemin}}個志願</div>
                </div>
            @endif
            <table class="ui celled striped table">
                <thead>
                <tr><th colspan="3"><h3>志願選擇<p style="font-size: 0.4em;color:red;">請至少填{{$choosemin}}個志願</p></h3></th>
                </tr></thead><tbody>
                @for ($i = 0; $i < $choosemax; $i++)
                    <tr>
                        <td class="collapsing"><pre>  第{{$i+1}}志願  </pre></td>
                        <td>
                            {{--<select id="choose{{$i+1}}" name="choose[]">
                                <option value="#">請選擇</option>
                            </select>--}}
                            <div class="ui selection dropdown fluid chooseall" id="choose{{$i+1}}">
                                <input type="hidden" name="choose[]">
                                <div class="default text">請選擇</div>
                                <i class="dropdown icon"></i>
                                <div class="menu" style="max-height: 20em;">
                                    <div class="item" data-value="#">請選擇</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
            @if(isset($change)&&$change==2)
                <input type="hidden" name="change" value="2" />
            @endif
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="ui buttons fluid">
                <button class="ui positive button" type="submit">送出</button>
                <div class="or"></div>
                <a class="ui button" href="./">取消</a>
            </div>
        </form>
        <script>

            Array.prototype.remove = function () {
                var what, a = arguments, L = a.length, ax;
                while (L && this.length) {
                    what = a[--L];
                    while ((ax = this.indexOf(what)) !== -1) {
                        this.splice(ax, 1);
                    }
                }
                return this;
            };

            $('.ui.dropdown').dropdown();
            var clubsname=[
                @for ($i=0;$i<count($clubs);$i++)
                '{{$clubs[$i]->name}}'@if($i!=(count($clubs)-1)),@endif
                @endfor
            ];
            var clubsnum=[
                @for ($i=0;$i<count($clubs);$i++)
                '{{$clubs[$i]->id}}'@if($i!=(count($clubs)-1)),@endif
                @endfor
            ];
            var clubslast=[
                @for ($i=0;$i<count($clubs);$i++)
                '{{$clubs[$i]->max-$clubs[$i]->stu_in}}'@if($i!=(count($clubs)-1)),@endif
                @endfor
            ];
            for(var i=0;i<clubsnum.length;i++) {
                $('#choose1').children(".menu").append("<div class=item data-value=" + clubsnum[i] + ">" + clubsname[i] +"<"+clubslast[i]+">"+ "</div>");
            }
            @for ($i=1;$i<=$choosemax;$i++)
                var tempnum{{$i}}=0;
                var tempname{{$i}}="";
                var templast{{$i}}=0;
                $('#choose{{$i}}').change(function (){
                    if(tempnum{{$i}}!=0)
                    {
                        clubsname[clubsname.length]=tempname{{$i}};
                        clubsnum[clubsnum.length]=tempnum{{$i}};
                        clubslast[clubslast.length]=templast{{$i}};
                    }
                    tempnum{{$i}}=$(this).children("input").val();
                    tempname{{$i}}=clubsname[clubsnum.indexOf($(this).children("input").val())];
                    templast{{$i}}=clubslast[clubsnum.indexOf($(this).children("input").val())];
                    clubsname.splice(clubsnum.indexOf($(this).children("input").val()),1);
                    clubslast.splice(clubsnum.indexOf($(this).children("input").val()),1);
                    clubsnum.remove($(this).children("input").val());
                    for(var y=1;y<={{$choosemax}};y++)
                    {
                        if(y!={{$i}})
                        {
                            $('#choose'+y).children(".menu").html('<div class="item" data-value="#">請選擇</div>');
                            for(var i=0;i<clubsnum.length;i++) {
                                $('#choose'+y).children(".menu").append("<div class=item data-value=" + clubsnum[i] + ">" + clubsname[i] +"<"+clubslast[i]+">"+ "</option>");
                            }
                        }
                    }
                 });
            @endfor

            $(".chooseall").children("input").val('');


            @if(isset($clubschoose))
                function start() {
                @for($i=0;$i<count($clubschoose);$i++)
                    setTimeout(function(){$('#choose{{$i+1}}').dropdown("set selected", {{$clubschoose[$i]->id}});},10);
                @endfor
                }
            @endif
            {{--
            $('#choose3').dropdown("set selected",);
            --}}
        </script>
    </div>
@endsection
