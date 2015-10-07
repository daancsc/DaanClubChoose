# DaanClubChoose大安高工綜合活動選課系統

採用laravel 4.2框架 所寫而成

##系統需求
>PHP >= 5.4<br>
>MCrypt PHP 套件<br>
>PHP JSON 套件<br>

##安裝說明

###安裝框架
詳細安裝方式可參考以下網址<br>
http://laravel.tw/docs/4.2/installation<br>
以下為大略步驟<br>
>1.git clone<br>
>2.安裝composer<br>
>3.在目錄下 執行composer update<br>
>4.在目錄下 app/storage 要有寫入權限<br>
>5.設定路徑複寫 指定所有請求送至public/index.php 上<br>
>>apache<br>
>>Options +FollowSymLinks<br>
>>RewriteEngine On<br>
>><br>
>>RewriteCond %{REQUEST_FILENAME} !-d<br>
>>RewriteCond %{REQUEST_FILENAME} !-f<br>
>>RewriteRule ^ index.php [L]<br>
<br>
>>nginx 根網域下<br>
>>location / {<br>
>>    try_files $uri $uri/ /index.php?$query_string;<br>
>>}<br>
<br>
>>nginx 資料夾下<br>
>>location /choose {<br>
>>    try_files $uri $uri/ /choose/index.php?$query_string;<br>
>>}<br>

###安裝設定<br>
>1.創 新資料庫 /帳號<br>
>2.匯入在根目錄下DaanClubChoose.sql<br>
>3.解壓縮config.zip在app資料夾下<br>
>4.app/config/app.php 裡 <br>
>>debug為是否顯示錯誤訊息<br>
>>key 加密字串 請照長度輸入隨機字串<br>

>5.app/config/database.php裡<br>
>>資料庫設定<br>
>>有mysql的註解<br>

>6.app/config/session.php<br>
>>lifetime 為登入閒置多久 自動登出<br>

>7.app/views/layout.blade.php 與 app/views/admin/layout.blade.php<br>
>>修改學校標題<br>

>8.進入資料庫在admin加入管理帳號<br>
>>account為帳號 comment為名稱 password為密碼<br>
>>注意!password為使用框架內建密碼加密 需至app/route.php裡把最後的路取消由註解<br>
>>使用此路由取得加密字串 使用完請註解<br>
<br>

##架構路徑<br>











