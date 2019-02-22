<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2019/2/21
 * Time: 16:17
 */

namespace app\controllers\volume;


use app\controllers\basis\CommonController;
use vendor\project\database\User;
use vendor\project\database\Volume;
use vendor\project\database\VRelation;
use vendor\project\helpers\Msg;

class UseController extends CommonController
{
    public function actionUse($id = 0)
    {
        return $this->render('use', [
            'tel' => $id ? User::findOne($id)->tel : '',
            'volume' => $id ? Volume::getUserVolume($id) : []
        ]);
    }

    /**
     * 获取用户数据提供查询
     */
    public function actionGetUsers()
    {
        $user = User::find()
            ->select(['id', 'tel', 'name'])
            ->orderBy('id asc')
            ->asArray()->all();
        echo json_encode(['message' => '', 'value' => $user], JSON_UNESCAPED_UNICODE);
        exit();
    }

    /**
     * 查询用户票券信息
     * @param $id
     * @return string
     */
    public function actionGetUserVolume($id)
    {
        return $this->rJson(Volume::getUserVolume($id));
    }

    /**
     * 扣除票券
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        Msg::set('扣除错误');
        $model = VRelation::findOne($id);
        $model->status = 1;
        $model->updated_at = time();
        if ($model->save()) {
            Msg::set('扣除成功');
        }
        return $this->redirect(['use?id=' . $model->user_id]);
    }
}