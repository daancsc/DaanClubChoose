@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.setting" style="margin-left:5em;">
            @if(Session::get('write')==1)
                <div class="ui info message">
                    修改設定成功
                </div>
            @endif
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="2"><h4>系統設定</h4></th></thead>
                <tbody>
                <tr>
                    <td class="right aligned" width="50%">開放登入系統：</td>
                    <td class="left aligned"  width="50%">
                        <div class="ui left floated compact segment" style="padding: 0.6em;">
                            <div class="ui fitted toggle checkbox">
                                <input type="checkbox" {{$status->value==1?'checked="checked"':''}} name="status">
                                <label></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">學生分發結果標題：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui input" style="width:50%;">
                            <input type="text" id="text" value="{{{$resulttitle->value}}}" name="resulttitle">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">對未錄取的同學顯示未錄取：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui left floated compact segment" style="padding: 0.6em;">
                            <div class="ui fitted toggle checkbox">
                                <input type="checkbox"  {{$resultview->value==1?'checked="checked"':''}} name="resultview">
                                <label></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">當前一項為「顯示」時，開放修改志願：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui left floated compact segment" style="padding: 0.6em;">
                            <div class="ui fitted toggle checkbox">
                                <input type="checkbox" {{$noresultchange->value==1?'checked="checked"':''}} name="noresultchange">
                                <label></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">開放已選上同學重選：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui left floated compact segment" style="padding: 0.6em;">
                            <div class="ui fitted toggle checkbox">
                                <input type="checkbox" {{$resultchange->value==1?'checked="checked"':''}} name="resultchange">
                                <label></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">學生最少選填志願數：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui input" style="width:4em;">
                            <input type="text" value="{{{$choosemin->value}}}" name="choosemin">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="right aligned" width="50%">重要公告（會突顯顯示於公告上)(不需要就留0）：</td>
                    <td class="left aligned" width="50%">
                        <div class="ui input" style="width:80%;">
                            <input type="text" value="{{{$post_important->value}}}" name="post_important">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><h5>公告</h5></td colspan="2">
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea class="ckeditor" name="home_post">{{$home_post->value}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="ui buttons">
                            <button class="ui large positive submit button" type="submit">確認送出</button>
                            <div class="or"></div>
                            <button class="ui large button" type="reset">還原</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <br>
            <br>
        </form>
        <script>
            $(".checkbox").checkbox();
        </script>
        <script type="text/javascript" src="./html_edit/ckeditor.js"></script>
    </div>
@endsection