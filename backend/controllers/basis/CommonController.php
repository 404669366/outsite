<?php
/**
 * Created by PhpStorm.
 * User: 40466
 * Date: 2018/9/21
 * Time: 14:41
 */

namespace app\controllers\basis;


use vendor\project\database\Power;

class CommonController extends BasisController
{
    /**
     * 登录验证及权限验证
     * @param \yii\base\Action $action
     * @return bool|void
     */
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->redirect([\Yii::$app->params['loginRoute']],'请先登录')->send();
        }
        if (!Power::pass()) {
            return $this->redirect([\Yii::$app->params['indexRoute']],'您没有该操作权限')->send();
        }
        return parent::beforeAction($action);
    }
}