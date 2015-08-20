@extends('admin.layout')

@section('main')
    <div class="ui middle aligned center aligned grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <div class="ui card six wide column center aligned"  style="margin-left:5em;">
            <div class="content">
                <div class="header">學生</div>
                <br>
                <div class="description stackable">
                    <div class="ui statistic">
                        <div class="label">總共</div>
                        <div class="value">{{{Student::all()->count()}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">已選課</div>
                        <div class="value">{{{Student::where('chosen','=','1')->count()}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">未選課</div>
                        <div class="value">{{{Student::all()->count()-Student::where('chosen','=','1')->count()}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">強制</div>
                        <div class="value">{{{Student::where('forced','=','1')->count()}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">未錄取學生</div>
                        <div class="value">{{{Student::all()->count()-Club::all()->sum('stu_in')}}}</div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="ui card six wide column center aligned" style="margin-top:0px;margin-bottom:1em;">
            <div class="content">
                <div class="header">課程</div>
                <br>
                <div class="description stackable">
                    <div class="ui statistic">
                        <div class="label">總共</div>
                        <div class="value">{{{Club::all()->count()}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">總共可提供名額</div>
                        <div class="value">{{{Club::all()->sum('max')}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">已錄取名額</div>
                        <div class="value">{{{Club::all()->sum('stu_in')}}}</div>
                    </div>
                    <div class="ui statistic">
                        <div class="label">剩餘名額</div>
                        <div class="value">{{{Club::all()->sum('max')-Club::all()->sum('stu_in')}}}</div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="ui card five wide column center aligned" style="margin-top:0px;margin-bottom:1em;margin-left:5em;">
            <div class="content">
                <div class="header">前十熱門的課程</div>
                <br>
                <div class="description stackable">
                    <div class="ui middle aligned divided list">
                        @for($i=0;$i<count($pop);$i++)
                            <div class="item">
                                <div class="content">
                                    {{{$i+1}}}.{{{$pop[$i]->name}}}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="ui card five wide column center aligned" style="margin-top:0px;margin-bottom:1em;">
            <div class="content">
                <div class="header">前十冷清的課程</div>
                <br>
                <div class="description stackable">
                    <div class="ui middle aligned divided list">
                        @for($i=0;$i<count($cold);$i++)
                            <div class="item">
                                <div class="content">
                                    {{{$i+1}}}.{{{$cold[$i]->name}}}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection