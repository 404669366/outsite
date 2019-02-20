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
     * 返回分页数据
     * @param array $data
     * @return string
     */
    public function rPageJson($data = [])
    {
        echo json_encode(['total' => $data['total'], 'data' => $data['data']], JSON_UNESCAPED_UNICODE);
        exit();
    }

    /**
     * 自定义错误页
     * @return string
     */
    public function actionError()
    {
        return $this->render('error');
    }

    /**
     * 自定义消息提示页并返回上一页
     * @return string
     */
    public function actionMsgBack()
    {
        return $this->render('msg');
    }
}