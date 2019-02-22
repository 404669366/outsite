<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/2/22
 * Time: 13:12
 */

namespace app\controllers\user;


use app\controllers\basis\CommonController;
use vendor\project\database\Volume;

class VolumeController extends CommonController
{
    /**
     * 用户票券列表页
     * @return string
     */
    public function actionList()
    {
        return $this->render('list', ['data' => Volume::getUserVolume()]);
    }
}