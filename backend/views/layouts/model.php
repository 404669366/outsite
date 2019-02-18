<?php
\app\assets\ModelAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>博瑞恩贝</title>
    <?php $this->head(); ?>
</head>
<body class="gray-bg">
<?php $this->beginBody(); ?>
<?php $this->endBody(); ?>
<script>
    $(function () {
        $('.back').prop('type','button');
        $('.back').click(function () {
            history.go(-1);
        });
    });
</script>
<?php \vendor\project\helpers\Msg::run() ?>
<div class="wrapper wrapper-content animated">
    <?= $content ?>
</div>
</body>
</html>
<?php $this->endPage() ?>

