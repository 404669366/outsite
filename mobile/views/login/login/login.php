<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="/resources/js/sms.js" type="text/javascript" charset="utf-8"></script>
    <link href="/resources/css/login.css" rel="stylesheet">
    <?php \vendor\project\helpers\Msg::run() ?>
</head>
<body>
<span class="boxCenter">
    <div class="loginBox">
        <div class="tit">博瑞恩贝</div>
        <div class="text">
            <input class="tel" type="text" placeholder="账号">
        </div>
        <div class="text">
            <input class="code" type="text" placeholder="验证码">
            <div class="click">发送</div>
        </div>
        <button class="text button">登 录</button>
    </div>
</span>
<script>
    sms({
        click: '.click',
        telModel: '.tel'
    });
</script>
</body>
</html>
