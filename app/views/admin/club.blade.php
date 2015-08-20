@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.club" style="margin-left:5em;">
            @if(Session::get('write')==1)
                <div class="ui info message">
                    新增課程成功
                </div>
            @endif
            @if(Session::get('write')==2)
                <div class="ui info message">
                    修改課程成功
                </div>
            @endif
            @if(Session::get('write')==4)
                <div class="ui info message">
                    順序修改成功
                </div>
            @endif
            @if(Session::get('write')==3)
                <div class="ui info message">
                    刪除課程成功
                </div>
            @endif
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="8"><h4>課程設定</h4></th></thead>
                <tbody>
                <tr>
                    <td colspan="3" class="right aligned">新增課程</td>
                    <td colspan="4">
                        <div class="ui form">
                            <div class="fields">
                                <div class="ui field mini input">
                                    <input placeholder="課程名稱" type="text" name="name">
                                </div>
                                <div class="ui field mini input">
                                    <input placeholder="老師" type="text" name="teacher">
                                </div>
                                <div class="ui field mini input">
                                    <input placeholder="地點" type="text" name="place">
                                </div>
                                <div class="ui field mini input">
                                    <input placeholder="雨備地點" type="text" name="place_rain">
                                </div>
                                <div class="ui field mini input">
                                    <input placeholder="名額" type="text" name="max">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><button class="ui mini positive submit button fluid" type="submit" name="add">新增</button></td>
                </tr>
                <tr>
                    <td style="padding:0em;">編號</td>
                    <td style="padding:0em;">課程名稱</td>
                    <td>老師</td>
                    <td>上課地點</td>
                    <td>雨備地點</td>
                    <td>已錄取</td>
                    <td>名額限制</td>
                    <td>操作</td>
                </tr>
                @for($i=0;$i<count($clubs);$i++)
                <tr>
                    <td style="padding:0em;">
                        <div class="ui input small" style="width:3.5em;">
                            <input type="text" value="{{$clubs[$i]->sn}}" name="sn{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td style="padding:0em;">
                        <div class="ui input small" style="width:12em;">
                            <input type="text" value="{{$clubs[$i]->name}}" name="name{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="ui input small" style="width:5.5em;">
                            <input type="text" value="{{$clubs[$i]->teacher}}" name="teacher{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="ui input small" style="width:12em;">
                            <input type="text" value="{{$clubs[$i]->place}}" name="place{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td>
                        <div class="ui input small" style="width:8em;">
                            <input type="text" value="{{$clubs[$i]->place_rain}}" name="place_rain{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td>{{$clubs[$i]->stu_in}}</td>
                    <td>
                        <div class="ui input small">
                            <input type="text" value="{{$clubs[$i]->max}}" name="max{{$clubs[$i]->id}}">
                        </div>
                    </td>
                    <td>
                        <?php
                            $uid=0;
                            if($i!=0){
                                $uid=$i-1;
                            }
                            $did=0;
                            if($i+1<count($clubs)){
                                $did=$i+1;
                            }
                        ?>
                        <a href="./admin.club.sort.{{$clubs[$uid]->sn}}.{{$clubs[$i]->sn}}">
                            <i class="arrow up icon"></i>
                        </a>
                        <a href="./admin.club.sort.{{$clubs[$i]->sn}}.{{$clubs[$did]->sn}}">
                            <i class="arrow down icon"></i>
                        </a>
                        <a onclick="del({{$clubs[$i]->id}})">
                            <i class="remove icon"></i>
                        </a>
                    </td>
                </tr>
                @endfor
                <tr>
                    <td colspan="8">
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
            function del(id)
            {
                var check=confirm("確定刪除課程");
                if(check)
                {
                    document.location.href="./admin.club.del."+id;
                }
            }
        </script>
    </div>
@endsection