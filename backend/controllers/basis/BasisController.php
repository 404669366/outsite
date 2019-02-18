<?php
/**
 * Created by PhpStorm.
 * User: 40466
 * Date: 2018/9/21
 * Time: 10:16
 */

namespace app\controllers\basis;


use vendor\project\helpers\Msg;
use yii\web\Controller;

class BasisController extends Controller
{
    /**
     * 重写goBack，返回上一页
     * @param string $msg
     * @return \yii\web\Response
     */
    public function goBack($msg = '')
    {
        Msg::set($msg);
        return parent::goBack(\Yii::$app->request->getReferrer());
    }

    /**
     * 重写render，返回基础数据
     * @param string $view
     * @param array $params
     * @param string $msg
     * @return string
     */
    public function render($view, $params = [], $msg = '')
    {
        Msg::set($msg);
        return parent::render($view, $params);
    }

    /**
     * 重写redirect，返回弹窗信息
     * @param array|string $url
     * @param string $msg
     * @param int $statusCode
     * @return \yii\web\Response
     */
    public function redirect($url, $msg = '', $statusCode = 302)
    {
        Msg::set($msg);
        return parent::redirect($url, $statusCode);
    }

    /**
     * 返回json数据
     * @param array $data
     * @param bool $type
     * @param string $msg
     * @return string
     */
    public function rJson($data = [], $type = true, $msg = 'ok')
    {
        echo json_encode(['type' => $type, 'msg' => $msg, 'data' => $data], JSON_UNESCAPED_UNICODE);
        exit();
    }

    /**
     * 返回适合dataTable的数据
     * @param array $data
     * @return string
     */
    public function rTableData($data = [])
    {
        echo json_encode(['total' => $data['total'], 'data' => $data['data']], JSON_UNESCAPED_UNICODE);
        exit();
    }
}