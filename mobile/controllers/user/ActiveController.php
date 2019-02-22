<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/2/22
 * Time: 12:14
 */

namespace app\controllers\user;


use app\controllers\basis\CommonController;
use vendor\project\database\ARelation;

class ActiveController extends CommonController
{
    /**
     * 用户参与活动列表页
     * @return string
     */
    public function actionList()
    {
        return $this->render('list', ['data' => ARelation::getUserActive()]);
    }
}