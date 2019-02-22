<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>博瑞恩贝 - 活动列表</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/resources/css/active.css">
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
<?php if ($data): ?>
    <div class="list">
        <?php foreach ($data as $v): ?>
            <div class="listOne">
                <span class="center">
                    <div class="title">
                        <?= $v['title'] ?>
                    </div>
                </span>
                <div class="no">
                    <?= $v['no'] ?>&emsp;
                    <?= date('Y-m-d H:i:s', $v['created_at']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="message">
        您没有报名任何活动!
    </div>
<?php endif; ?>
</body>
</html>