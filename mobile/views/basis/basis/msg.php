<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>错误提示</title>
    <script src="/resources/js/common.js" type="text/javascript" charset="utf-8"></script>
    <?php \vendor\project\helpers\Msg::run() ?>
</head>
<body>
<script type="text/javascript">
    var num = 3;
    var id = setInterval(function () {
        num--;
        if (num === 0) {
            clearInterval(id);
            history.back(-1);
        }
    }, 1000);
</script>
</body>
</html>
