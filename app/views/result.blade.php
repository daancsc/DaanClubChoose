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
        <form  class="ui container segment" method="post" action="./resultwrite">
            @if(Session::get('write')==1)
                <div class="ui info message">
                    填寫成功
                </div>
            @endif
            @if(Session::get('write')==2)
                <div class="ui info message">
                    修改成功
                </div>
            @endif
            <table class="ui celled striped table">
                <thead>
                <tr><th colspan="3"><h3>{{!isset($chosen)?'確認選擇志願':$title}}</h3></th>
                </tr></thead><tbody>
                @for ($i = 0; $i < count($result); $i++)
                    <tr>
                        <td class="collapsing"><pre>  第{{$i+1}}志願  </pre></td>
                        <td>
                            {{$result[$i]->name}}
                            <input type="hidden" name="choose[]" value="{{$result[$i]->id}}">
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @if(!isset($chosen))
                <div class="ui buttons fluid">
                    <button class="ui positive button" type="submit">確認送出</button>
                    <div class="or"></div>
                    <input type ="button" class="ui button" onclick="history.back()" value="取消"></input>
                </div>
            @else
                <a class="ui blue button fluid" href="./chosenchange">修改志願</a>
            @endif
            @if(isset($change)&&$change==2)
                <input type="hidden" name="change" value="2">
            @endif
        </form>
    </div>
@endsection