<?php
/**
 * Created by PhpStorm.
 * User: 40466
 * Date: 2018/9/21
 * Time: 14:43
 */

namespace app\controllers\member;


use app\controllers\basis\BasisController;
use vendor\project\database\Member;
use vendor\project\helpers\CaptchaCode;
use vendor\project\helpers\Msg;

class LoginController extends BasisController
{
    /**
     * 用户登录
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $this->layout = false;
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            Msg::set('验证码错误');
            if (CaptchaCode::validate($data['code'], 'Login')) {
                if (Member::accountLogin($data['username'], $data['pwd'])) {
                    return $this->redirect([\Yii::$app->params['defaultRoute']], '登录成功');
                }
                Msg::set('账号或密码错误');
            }
        }
        return $this->render('login');
    }

    /**
     * 用户退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['login'], '注销成功');
    }

    /**
     * 图形验证码
     */
    public function actionCode()
    {
        $model = new CaptchaCode();
        $model->doimg('Login');
    }
}