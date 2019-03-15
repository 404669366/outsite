<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>博瑞恩贝 - 报名活动</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/resources/css/join.css">
    <?php \vendor\project\helpers\Msg::run() ?>
</head>
<body>
    <span class="center">
        <div class="box">
            <div class="title">您确定要报名参加此次活动吗?</div>
            <div class="btns">
                <a class="btn no" href="/api/active/join.html?no=<?= $no ?>&sure=2">暂时不报</a>
                &emsp;
                <a class="btn" href="/api/active/join.html?no=<?= $no ?>&sure=1">立即报名</a>
            </div>
        </div>
    </span>
</body>
</html>