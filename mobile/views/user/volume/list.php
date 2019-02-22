<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>博瑞恩贝 - 票券列表</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/resources/css/volume.css">
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
                        <div class="name"><?= ($v['money'] ? $v['money'] . '元' : '') . $v['type'] ?></div>
                        <div class="status"><?= $v['status'] ?></div>
                    </div>
                </span>
                <div class="time">
                    <?= date('Y-m-d H:i:s', $v['begin_at']) ?>
                    -
                    <?= date('Y-m-d H:i:s', $v['end_at']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="message">
        您没有任何票券!
    </div>
<?php endif; ?>
</body>
</html>