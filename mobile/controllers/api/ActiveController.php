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
     * @param int $sure
     * @return string|\yii\web\Response
     */
    public function actionJoin($no = '', $sure = 0)
    {
        if (!$sure) {
            return $this->render('join', ['no' => $no]);
        }
        if ($sure == 1 && Active::userJoin($no)) {
            return $this->redirect(['user/active/list']);
        }
        return $this->redirect(['user/user/center']);
    }
}