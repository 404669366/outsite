<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/2/20
 * Time: 14:55
 */

namespace app\controllers\api;


use app\controllers\basis\CommonController;
use vendor\project\database\Active;

class ActiveController extends CommonController
{
    /**
     * 加入活动
     * @param string $no
     * @return \yii\web\Response
     */
    public function actionJoin($no = '')
    {
        if (Active::userJoin($no)) {
            return $this->redirect(['user/active/list']);
        }
        return $this->redirect(['user/user/center']);
    }
}