<?php

namespace app\controllers\login;


use app\controllers\basis\BasisController;
use vendor\project\database\User;
use vendor\project\helpers\Msg;
use vendor\project\helpers\Sms;
use vendor\project\helpers\Url;
use vendor\project\helpers\Wechat;

class LoginController extends BasisController
{
    /**
     * 手机验证码登录
     * @return string
     */
    public function actionLogin()
    {
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            Msg::set('手机号不能为空');
            if ($data['loginTel']) {
                Msg::set('验证码有误');
                if (Sms::validateCode($data['loginTel'], $data['loginTelCode'])) {
                    Msg::set('账号不存在');
                    if ($model = User::findOne(['tel' => $data['loginTel']])) {
                        $model->wechat = \Yii::$app->session->get('UserWechat', '');
                        $model->save();
                        \Yii::$app->user->login($model, 60 * 60 * 2);
                        return $this->redirect(Url::getUrl(), '登录成功');
                    }
                }
            }
        }
        return $this->render('login');
    }

    /**
     * 微信登录回调
     * @param string $code
     * @return \yii\web\Response
     */
    public function actionLoginW($code = '')
    {
        if ($code) {
            if ($info = Wechat::getUserAuthorizeAccessToken($code)) {
                if ($model = User::findOne(['wechat' => $info['openid']])) {
                    \Yii::$app->user->login($model, 60 * 60 * 2);
                    return $this->redirect(Url::getUrl(), '登录成功');
                }
                \Yii::$app->session->set('UserWechat', $info['openid']);
            }
        }
        return $this->redirect(['login/login/login']);
    }

    /**
     * 退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        if (Wechat::isWechat()) {
            if ($model = User::findOne(\Yii::$app->user->id)) {
                $model->wechat = '';
                $model->save();
            }
        }
        \Yii::$app->user->logout();
        return $this->redirect(['login'], '退出成功');
    }
}