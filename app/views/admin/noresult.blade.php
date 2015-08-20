@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="" style="margin-left:5em;">
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="10"><h4>選填狀態</h4></th></thead>
                <tbody>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="4">
                        <select class="ui dropdown search" name="club"  onChange="location = this.options[this.selectedIndex].value;">
                            <option value="#"></option>
                            <option value="./admin.noresult">全部</option>
                            @foreach($classes as $class)
                                <option value="./admin.noresult.{{$class->id}}">{{$class->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="3"></td>
                </tr>
                </tbody>
            </table>
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="6"><h4>未錄取名單</h4></th></thead>
                <tbody>
                <tr>
                    <td>編號</td>
                    <td>學號</td>
                    <td>班級</td>
                    <td>座號</td>
                    <td>名字</td>
                    <td class="right aligned" style="padding: 0em;">原因</td>
                </tr>
                @if(isset($noresult))
                    @for($i=0;$i<count($noresult);$i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$noresult[$i]->account}}</td>
                            <td>{{$noresult[$i]->class}}</td>
                            <td>{{$noresult[$i]->seat}}</td>
                            <td>{{$noresult[$i]->name}}</td>
                            <td class="right aligned" style="padding: 0em;width:20%;">{{$because[$i]}}</td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
            <br>
            <br>
            <br>
        </form>
    </div>
@endsection