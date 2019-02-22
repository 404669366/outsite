<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/2/20
 * Time: 15:05
 */

namespace app\controllers\user;


use app\controllers\basis\CommonController;

class UserController extends CommonController
{
    /**
     * 个人中心
     * @return string
     */
    public function actionCenter()
    {
        return $this->render('center');
    }

    /**
     * 账户信息
     * @return string
     */
    public function actionInfo()
    {
        return $this->render('info');
    }
}