<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>博瑞恩贝 - 个人中心</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <link href="/resources/css/center.css" rel="stylesheet">
    <?php \vendor\project\helpers\Msg::run() ?>
</head>
<body>
<div class="head">
    <img src="/resources/img/logo.jpg">
    <span class="info">
        用户 : <?= Yii::$app->user->identity->name ?>
        <br>
        Tel : <?= Yii::$app->user->identity->tel ?>
    </span>
</div>
<div class="menu">
    <div class="menuOne" onclick="clickGo(this)" go="/user/user/info.html">
        <div class="ico"><i class="fa fa-address-book-o" aria-hidden="true"></i></div>
        <div class="name">账户信息</div>
        <div class="go"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
    </div>
    <div class="menuOne" onclick="clickGo(this)" go="/user/active/list.html">
        <div class="ico"><i class="fa fa-spotify" aria-hidden="true"></i></div>
        <div class="name">我的活动</div>
        <div class="go"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
    </div>
    <div class="menuOne" onclick="clickGo(this)" go="/user/volume/list.html">
        <div class="ico"><i class="fa fa-ticket" aria-hidden="true"></i></div>
        <div class="name">我的票券</div>
        <div class="go"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
    </div>
</div>
<div class="foot">
    <a href="/login/login/logout.html">退出登录</a>
</div>
</body>
</html>
