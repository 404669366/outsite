<?php
/**
 * Created by PhpStorm.
 * User: zhangjiajing
 * Date: 2017/6/12
 * Time: 15:55
 */

namespace app\assets;

use yii\web\AssetBundle;
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/h+/css/bootstrap.min.css',
        '/h+/css/font-awesome.css?v=4.4.0',
        '/h+/css/animate.css',
        '/h+/css/style.css',
        '/h+/css/login.css',
    ];
    public $js = [
        '/h+/js/jquery.min.js?v=2.1.4',
        '/h+/js/plugins/layer/layer.min.js',
    ];
}
