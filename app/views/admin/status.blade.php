@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.student" style="margin-left:5em;">
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="10"><h4>選填狀態</h4></th></thead>
                <tbody>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4">
                        <select class="ui dropdown search" name="club"  onChange="location = this.options[this.selectedIndex].value;">
                            <option value="#"></option>
                            @foreach($clubs as $club)
                                <option value="./admin.status.{{$club->id}}">{{$club->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="3"></td>
                </tr>
                </tbody>
            </table>
            <?php $result=Session::get('result');?>
            @if(isset($result))
            <div class="ui card fluid" style="text-align: center;">
                <div class="content">
                    <div class="header">{{{Club::find(Session::get('id'))->name}}}</div>
                    <br>
                    <div class="description stackable">
                        <div class="ui statistic">
                            <div class="label">填寫數</div>
                            <div class="value">{{{count($result)-15}}}</div>
                        </div>
                        @for($i=1;$i<16;$i++)
                            <div class="ui statistic">
                                <div class="label">第{{$i}}選擇</div>
                                <div class="value">{{{Choose::where('choose'.$i,'=',Session::get('id'))->count()}}}</div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
                <table class="ui very basic table center aligned" border="0">
                    <thead><th colspan="6"><h4>結果</h4></th></thead>
                    <tbody>
                    <tr>
                        <td>志願</td>
                        <td>學號</td>
                        <td>名字</td>
                        <td>班級</td>
                        <td>座號</td>
                        <td>時間</td>
                    </tr>
                    @for($i=0;$i<count($result);$i++)
                        <?php
                            if(is_numeric($result[$i])){
                                $choose1=$result[$i];
                            }
                            else { ?>
                                <tr>
                                    <td>{{$choose1}}</td>
                                    <td>{{$result[$i]->account}}</td>
                                    <td>{{$result[$i]->name}}</td>
                                    <td>{{$result[$i]->class}}</td>
                                    <td>{{$result[$i]->seat}}</td>
                                    <td>{{Choose::where('stu_id','=',$result[$i]->id)->first()->date}}</td>
                                </tr>
                        <?php } ?>
                    @endfor
                    </tbody>
                </table>
            @endif
            <br>
            <br>
            <br>
        </form>
        <script>
            $('.ui.dropdown').dropdown();
        </script>
    </div>
@endsection