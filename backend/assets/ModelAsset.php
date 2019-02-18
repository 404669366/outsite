<?php
/**
 * Created by PhpStorm.
 * User: zhangjiajing
 * Date: 2017/6/12
 * Time: 15:55
 */

namespace app\assets;

use yii\web\AssetBundle;

class ModelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/h+/css/bootstrap.min.css?v=3.3.6',
        '/h+/css/font-awesome.css?v=4.4.0',
        '/h+/css/animate.css',
        '/h+/css/plugins/dataTables/dataTables.bootstrap.css',
        '/h+/css/plugins/iCheck/custom.css',
        '/h+/css/plugins/blueimp/css/blueimp-gallery.min.css',
        '/h+/css/style.css?v=4.1.0',
    ];
    public $js = [
        '/h+/js/jquery.min.js?v=2.1.4',
        '/h+/js/bootstrap.min.js?v=3.3.6',
        '/h+/js/plugins/layer/layer.min.js',
        '/h+/js/plugins/dataTables/MyDataTable.js',
        '/upload/upload.js',
    ];
}
