<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>大安高工綜合活動選課系統</title>
    <link rel="stylesheet" type="text/css" href="./semantic/semantic.min.css" />
    <script src="./semantic/jquery-2.1.4.min.js"></script>
    <script src="./semantic/semantic.min.js"></script>

</head>

<body style="background-color:#f7f7f9;" onload="start()">

    <div class="ui menu borderless column {{!Agent::isMobile()?'fixed':''}}" style="background-color:#ff9800!important;">
        <div class="header item" style="text-align:center;">
            <h2 style="color:white;"><i class="cloud icon"></i>大安高工綜合活動選課系統</h2>
        </div>
        <div class="right menu">
            @if(Auth::check())
                <a class="ui item" style="color:white;" href="./admin.logout">登出</a>
            @endif
        </div>
    </div>
    @if(Auth::check())
        <div class="ui left demo fixed vertical inverted labeled icon menu sticky" style="{{!Agent::isMobile()?'margin-top:4.6em;':''}}">
            <!--ui left demo vertical inverted sidebar labeled icon menu-->
            <a class="item" href="./admin">
                <i class="dashboard icon"></i>狀態板
            </a>
            <a class="item" href="./admin.setting">
                <i class="settings icon"></i>系統設定
            </a>
            <a class="item" href="./admin.club">
                <i class="tasks icon"></i>課程管理
            </a>
            <a class="item" href="./admin.student">
                <i class="user icon"></i>學生管理
            </a>
            <a class="item" href="./admin.status">
                <i class="adjust icon"></i>選填狀態
            </a>
            <a class="item" href="./admin.deal">
                <i class="legal icon"></i>自動分發
            </a>
            <a class="item" href="./admin.result">
                <i class="unhide icon"></i>錄取結果
            </a>
            <a class="item" href="./admin.noresult">
                <i class="hide icon"></i>未錄取
            </a>
            <a class="item" href="./admin.doc">
                <i class="file word outline icon"></i>產生報表
            </a>
            <a class="item" onclick="reset()">
                <i class="reply icon"></i>重置
            </a>
        </div>
    @endif
    @yield('main')
    <div class="ui fluid center aligned segment" style="background-color:#ff9800!important;margin-bottom:-10px;{{Auth::check()?'position:fixed;bottom:0.8em;left:0em;width:100%;':''}}">
        <center>
            <h5 style="color:white;">By 大安高工電腦研究社 16th網管陳典佑</h5>
        </center>
    </div>



     <script>
         function reset()
         {
             var check=confirm("注意！此頁動作皆有不可回復性\r\n操作前請備份\r\n並了解自己在做什麼");
             if(check)
             {
                 document.location.href="./admin.reset";
             }
         }
     </script>
</body>

</html>
