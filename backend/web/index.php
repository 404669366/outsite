<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_GII') or define('YII_GII', true);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

(new yii\web\Application(require __DIR__ . '/../config/web.php'))->run();
