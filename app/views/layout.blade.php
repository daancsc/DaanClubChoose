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
            @if(Session::get('studentlogin')!=true)
                <a class="ui item" style="color:white;" href="./admin">管理登入</a>
            @endif
        </div>
    </div>

    <div class="ui grid {{!Agent::isMobile()?'container':''}} stackable">
        @yield('main')
    </div>

    <div class="ui fluid center aligned segment" style="background-color:#ff9800!important;margin-bottom:-10px;">
        <center>
            <h5 style="color:white;">By <a href="http://dacsc.club">大安高工電腦研究社</a> 16th網管陳典佑</h5>
        </center>
    </div>



</body>

</html>
