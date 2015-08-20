@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.student" style="margin-left:5em;">
            @if(Session::get('write')==1)
                <div class="ui info message">
                    新增學生成功
                </div>
            @endif
            @if(Session::get('write')==2)
                <div class="ui info message">
                    修改學生成功
                </div>
            @endif
            @if(Session::get('write')==3)
                <div class="ui info message">
                    刪除學生成功
                </div>
            @endif
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="11"><h4>學生搜尋</h4></th></thead>
                <tbody>
                <tr>
                    <td>學號</td>
                    <td colspan="3">
                        <div class="ui input small fluid">
                            <input type="text" value="" name="oaccount">
                        </div>
                    </td>
                    <td>姓名</td>
                    <td colspan="2">
                        <select class="ui dropdown fluid search" name="oname">
                            <option value="#"></option>
                            @foreach($student as $stu)
                                <option value="{{$stu}}">{{$stu}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>座號</td>
                    <td colspan="2">
                        <div class="ui input small fluid">
                            <input type="text" value="" name="oseat">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>班級</td>
                    <td colspan="2">
                        <select class="ui dropdown fluid search" name="oclass">
                            <option value="#"></option>
                            @foreach($class as $clas)
                                <option value="{{$clas}}">{{$clas}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td style="font-size: 0.8em;padding: 0em;">是否有選課</td>
                    <td>
                        <select class="ui dropdown compact" name="ochosen">
                            <option value="#"></option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>
                    <td style="font-size: 0.8em;padding: 0em;">是否強制</td>
                    <td>
                        <select class="ui dropdown compact" name="oforced">
                            <option value="#"></option>
                            <option value="1">是</option>
                            <option value="0">否</option>
                        </select>
                    </td>
                    <td style="font-size: 0.8em;padding: 0em;">第幾梯次上</td>
                    <td>
                        <select class="ui dropdown compact" name="ostage">
                            <option value="#"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button class="ui large positive submit button" type="submit">尋找</button>
                    </td>
                </tr>
                <?php $result=Session::get('result');?>
                @if(!isset($result))
                    <tr>
                        <td colspan="4" class="right aligned">新增學生</td>
                        <td colspan="5">
                            <div class="ui form">
                                <div class="fields">
                                    <div class="ui field mini input">
                                        <input placeholder="學號" type="text" name="waccount">
                                    </div>
                                    <div class="ui field mini input">
                                        <input placeholder="密碼" type="text" name="wpassword">
                                    </div>
                                    <div class="ui field mini input">
                                        <input placeholder="名字" type="text" name="wname">
                                    </div>
                                    <div class="ui field mini input">
                                        <input placeholder="班級" type="text" name="wclass">
                                    </div>
                                    <div class="ui field mini input">
                                        <input placeholder="座號" type="text" name="wseat">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><button class="ui mini positive submit button fluid" type="submit" name="add">新增</button></td>
                    </tr>
                @endif
                </tbody>
            </table>

            @if(isset($result))
                <table class="ui very basic table center aligned" border="0">
                    <thead><th colspan="12"><h4>搜尋結果</h4></th></thead>
                    <tbody>
                    <tr>
                        <td style="font-size: 0.8em;padding: 0em;">編號</td>
                        <td>學號</td>
                        <td>密碼</td>
                        <td>名字</td>
                        <td>班級</td>
                        <td>座號</td>
                        <td style="font-size: 0.6em;padding: 0em;">是否已選課</td>
                        <td style="font-size: 0.6em;padding: 0em;">第幾梯次上</td>
                        <td style="font-size: 0.8em;padding: 0em;">強制</td>
                        <td style="font-size: 0.8em;padding: 0em;">強制錄取</td>
                        <td style="font-size: 0.8em;padding: 0em;">修改志願</td>
                        <td style="font-size: 0.8em;padding: 0em;">結果</td>
                        <td style="font-size: 0.8em;padding: 0em;">刪除</td>
                    </tr>
                    @foreach($result as $res)
                        <tr>
                            <td>{{$res->id}}</td>
                            <td style="padding: 0em">
                                <div class="ui input small" style="width: 6em;">
                                    <input type="text" value="{{$res->account}}" name="account{{$res->id}}">
                                </div>
                            </td>
                            <td style="padding: 0em">
                                <div class="ui input small" style="width: 4.3em;">
                                    <input type="text" value="{{$res->password}}" name="password{{$res->id}}">
                                </div>
                            </td>
                            <td style="padding: 0em">
                                <div class="ui input small" style="width: 5.2em;">
                                    <input type="text" value="{{$res->name}}" name="name{{$res->id}}">
                                </div>
                            </td>
                            <td style="padding: 0em">
                                <div class="ui input small" style="width:6em;">
                                    <input type="text" value="{{$res->class}}" name="class{{$res->id}}">
                                </div>
                            </td>
                            <td style="padding: 0em">
                                <div class="ui input small" style="width: 3em;">
                                    <input type="text" value="{{$res->seat}}" name="seat{{$res->id}}">
                                </div>
                            </td>
                            <td style="padding: 0em;">
                                {{$res->chosen==1?'是':'否'}}
                            </td>
                            <td style="padding: 0em;">{{$res->stage}}</td>
                            <td style="padding: 0em;">{{$res->forced==1?'是':'否'}}</td>
                            <input type="hidden" name="id[]" value="{{$res->id}}">
                            <td>
                                <a onclick="forced({{$res->id}})">
                                    <i class="minus circle icon"></i>
                                </a>
                            </td>
                            <td>
                                <a onclick="modify({{$res->id}})">
                                    <i class="edit icon"></i>
                                </a>
                            </td>
                            <td>{{Choose::where('stu_id','=',$res->id)->count()>0&&$res->choose->result!=null?Club::find($res->choose->result)->name:'無'}}</td>
                            <td>
                                <a onclick="del({{$res->id}})">
                                    <i class="remove icon"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="12">
                            <div class="ui buttons">
                                <button class="ui large positive submit button" type="submit" name="modify">修改送出</button>
                                <div class="or"></div>
                                <button class="ui large button" type="reset">還原</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @endif
            <br>
            <br>
            <br>
        </form>
        <script>
            $('.ui.dropdown').dropdown();
            setTimeout(function(){$('.ui.dropdown').dropdown();},100);
            function del(id)
            {
                var check=confirm("確定刪除學生");
                if(check)
                {
                    document.location.href="./admin.student.del."+id;
                }
            }
            function modify(id)
            {
                var check=confirm("確定修改學生志願");
                if(check)
                {
                    document.location.href="./admin.student.modify."+id;
                }
            }
            function forced(id) {
                window.open ("./admin.forced."+id, "選擇課程", "height=400, width=300, toolbar =no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no");
            }
        </script>
    </div>
@endsection