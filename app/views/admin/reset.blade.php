@extends('admin.layout')

@section('main')
    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable" style="margin-top:3em;">
        <form class="ui large form  sixteen wide column" method="post" action="./admin.reset" style="margin-left:5em;"  enctype="multipart/form-data">
            <div class="ui warning message"  style="display:inherit">
                <div class="header">注意！</div>
                此頁動作皆有不可回覆性<br>請懂技術的人操作
            </div>
            @if(Session::get('write')==5)
                <div class="ui info message">
                    學生資料上傳成功
                </div>
            @endif
            @if(Session::get('write')==6)
                <div class="ui info message">
                    清除學生所選志願與結果成功
                </div>
            @endif
            @if(Session::get('write')==7)
                <div class="ui info message">
                    刪除綜高學生成功
                </div>
            @endif
            @if(Session::get('write')==8)
                <div class="ui info message">
                    清除結果成功
                </div>
            @endif
            @if(Session::get('write')==11)
                <div class="ui info message">
                    課程資料上傳成功
                </div>
            @endif
            <table class="ui very basic table center aligned" border="0">
                <thead><th colspan="4"><h4>重置</h4></th></thead>
                <tbody>
                <tr>
                    <td class="left aligned" >學生資料上傳csv</td>
                    <td class="center aligned">
                        csv檔 第一行為格式<br>例:班級,學號,座號,學生姓名,身分證<br>請注意！執行此動作請先備份
                    </td>
                    <td class="center aligned">
                        選擇檔案:<input type="file" name="filestu" id="file" accept="text/csv" />
                    </td>
                    <td class="right aligned">
                        <input type="submit" name="uploadstu" value="上傳檔案" />
                    </td>
                </tr>
                <tr>
                    <td class="left aligned" >課程資料上傳csv</td>
                    <td class="center aligned">
                        csv檔 第一行為格式<br>例:編號,課程名稱,授課教師,上課地點,雨備地點,名額限制<br>請注意！執行此動作請先備份
                    </td>
                    <td class="center aligned">
                        選擇檔案:<input type="file" name="fileclub" id="file" accept="text/csv" />
                    </td>
                    <td class="right aligned">
                        <input type="submit" name="uploadclub" value="上傳檔案" />
                    </td>
                </tr>
                <tr>
                    <td class="left aligned">清除學生所選志願與結果</td>
                    <td class="center aligned">
                        請注意！執行此動作請先備份<br>如需使用此功能 請把按鈕取消註解<br>使用瀏覽器開發人員工具
                    </td>
                    <td class="right aligned" colspan="2">
                        <!--<input type="submit" name="clear" value="清除" />-->
                    </td>
                </tr>
                <tr>
                    <td class="left aligned">刪除綜高學生</td>
                    <td class="center aligned">
                        請注意！執行此動作請先備份<br>如需使用此功能 請把按鈕取消註解<br>使用瀏覽器開發人員工具
                    </td>
                    <td class="right aligned" colspan="2">
                        <!--<input type="submit" name="complexstu" value="清除" />-->
                    </td>
                </tr>
                <tr>
                    <td class="left aligned">清除結果</td>
                    <td class="center aligned">
                        請注意！執行此動作請先備份<br>如需使用此功能 請把按鈕取消註解<br>使用瀏覽器開發人員工具
                    </td>
                    <td class="right aligned" colspan="2">
                        <!--<input type="submit" name="clearresult" value="清除" />-->
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <br>
            <br>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
@endsection