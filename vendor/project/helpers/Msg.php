<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2018/10/15
 * Time: 14:41
 */

namespace vendor\project\helpers;


class Msg
{
    /**
     * 设置消息
     * @param string $msg
     * @return bool
     */
    public static function set($msg = '')
    {
        if ($msg) {
            \Yii::$app->session->set(\Yii::$app->params['entryName'], $msg);
            return true;
        }
        return false;
    }

    /**
     * 渲染消息
     * @param string $fontSize
     */
    public static function run($fontSize = '')
    {
        $fontSize = $fontSize ? $fontSize : \Yii::$app->params['msgFontSize'];
        if ($msg = \Yii::$app->session->get(\Yii::$app->params['entryName'], false)) {
            \Yii::$app->session->set(\Yii::$app->params['entryName'], null);
            $str = <<<HTML
<script>
    $(function() {
      layer.msg('<span style="font-size:$fontSize;height:100%;line-height:100%">$msg</span>');
    })
</script>
HTML;
            echo $str;
        }
    }
}