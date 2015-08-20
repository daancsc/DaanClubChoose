@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.student" style="margin-left:5em;">
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="10"><h4>結果</h4></th></thead>
                <tbody>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        <label>以課程分</label>
                        <select class="ui dropdown search" name="club"  onChange="location = this.options[this.selectedIndex].value;">
                            <option value="#"></option>
                            @foreach($clubs as $club)
                                <option value="./admin.result.club.{{$club->id}}">{{$club->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="2">
                        <label>以班級分</label>
                        <select class="ui dropdown search" name="club"  onChange="location = this.options[this.selectedIndex].value;">
                            <option value="#"></option>
                            @foreach($class as $clas)
                                <option value="./admin.result.class.{{$clas}}">{{$clas}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="3"></td>
                </tr>
                </tbody>
            </table>
            <?php $result=Session::get('result'); $wish=Session::get('wish');?>
            @if(isset($result))
                <table class="ui very basic table center aligned" border="0">
                    <thead><th colspan="5"><h4>{{Session::get('name')}}</h4></th></thead>
                    <tbody>
                    <tr>
                        <td>學號</td>
                        <td>班級</td>
                        <td>座號</td>
                        <td>名字</td>
                        <td class="left aligned" style="padding: 0em;">分發結果</td>
                    </tr>
                    @for($i=0;$i<count($result);$i++)
                        <tr>
                            <td>{{$result[$i]->account}}</td>
                            <td>{{$result[$i]->class}}</td>
                            <td>{{$result[$i]->seat}}</td>
                            <td>{{$result[$i]->name}}</td>
                            <td class="left aligned" style="padding: 0em;width:20%;">{{$wish[$i] or Session::get('name')}}</td>
                        </tr>
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