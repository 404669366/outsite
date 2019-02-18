<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>404</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <?php \vendor\project\helpers\Msg::run() ?>
</head>
<body>
<div class="not_find">
    <div class="tit">
        404
        <div class="cont">页面不见啦!</div>
    </div>
    <div class="notMain" id="notMain">10秒后页面将跳转到上一页...</div>
    <div class="notBtn">
        <a href="javascript:history.back(-1)">立即跳转</a>&emsp;&emsp;
        <a href="/index/index/index.html">返回首页</a>
    </div>
</div>
</body>
<script type="text/javascript">
    var num = 10;
    var id = setInterval(function () {
        num--;
        document.getElementById('notMain').innerText = num + "秒后页面将跳转到上一页...";
        if (num === 0) {
            clearInterval(id);
            history.back(-1);
        }
    }, 1000);
</script>
</html>
