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
     * 账号密码登录
     * @return string
     */
    public function actionLoginP()
    {
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            Msg::set('手机号不能为空');
            if ($data['loginTel']) {
                Msg::set('密码不能为空');
                if ($data['pwd']) {
                    if ($model = User::findOne(['tel' => $data['loginTel']])) {
                        if (\Yii::$app->security->validatePassword($data['pwd'], $model->password)) {
                            $model->wechat = \Yii::$app->session->get('UserWechat', '');
                            $model->save();
                            \Yii::$app->user->login($model, 60 * 60 * 2);
                            return $this->redirect(Url::getUrl(), '登录成功');
                        }
                    }
                    Msg::set('账号或密码错误');
                }
            }
        }
        return $this->render('loginP');
    }

    /**
     * 手机验证码登录
     * @return string
     */
    public function actionLoginT()
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
        return $this->render('loginT');
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
        return $this->redirect(['login/login/login-t']);
    }

    /**
     * 忘记密码
     * @return string
     */
    public function actionLoginR()
    {
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            Msg::set('手机号不能为空');
            if ($data['loginTel']) {
                Msg::set('账号不存在');
                if ($model = User::findOne(['tel' => $data['loginTel']])) {
                    Msg::set('密码至少8位');
                    if ($data['loginPwd'] && strlen($data['loginPwd']) >= 8) {
                        Msg::set('验证码有误');
                        if (Sms::validateCode($data['loginTel'], $data['loginCode'])) {
                            $model->password = \Yii::$app->security->generatePasswordHash($data['loginPwd']);
                            if ($model->save()) {
                                return $this->redirect(['/login/login/login-p'], '密码重置成功');
                            }
                            Msg::set($model->errors());
                        }
                    }
                }
            }
        }
        return $this->render('loginR');
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
        return $this->redirect(['index/index/index'], '退出成功');
    }
}