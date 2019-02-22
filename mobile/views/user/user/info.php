<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>博瑞恩贝 - 账户信息</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/resources/css/info.css">
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
    <div class="menuOne">
        <div class="ico"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
        <div class="name">学生姓名:</div>
        <div class="info"><?= Yii::$app->user->identity->child_name ?></div>
    </div>
    <div class="menuOne">
        <div class="ico"><i class="fa fa-venus-mars" aria-hidden="true"></i></div>
        <div class="name">学生性别:</div>
        <div class="info"><?= \vendor\project\helpers\Constant::sex()[Yii::$app->user->identity->child_sex] ?></div>
    </div>
    <div class="menuOne">
        <div class="ico"><i class="fa fa-calendar" aria-hidden="true"></i></div>
        <div class="name">学生年龄:</div>
        <div class="info"><?= Yii::$app->user->identity->child_age ?></div>
    </div>
    <div class="menuOne">
        <div class="ico"><i class="fa fa-flag-o" aria-hidden="true"></i></div>
        <div class="name">学生班级:</div>
        <div class="info"><?= Yii::$app->user->identity->class ?></div>
    </div>
</div>
</body>
</html>
