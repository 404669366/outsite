<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2019/2/20
 * Time: 9:50
 */

namespace app\controllers\user;


use app\controllers\basis\CommonController;
use vendor\project\database\User;
use vendor\project\database\VRelation;
use vendor\project\helpers\Constant;
use vendor\project\helpers\Msg;

class UserController extends CommonController
{
    /**
     * 用户分页列表
     * @return string
     */
    public function actionList()
    {
        return $this->render('list', ['status' => Constant::userStatus()]);
    }

    /**
     * 用户分页列表数据
     * @return string
     */
    public function actionData()
    {
        return $this->rTableData(User::getPageData());
    }

    /**
     * 添加用户
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        if (\Yii::$app->request->isPost) {
            $model = new User();
            $data = \Yii::$app->request->post();
            $data['created'] = time();
            if ($model->load(['User' => $data]) && $model->validate() && $model->save()) {
                return $this->redirect('list', '添加用户成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('add', ['sex' => Constant::sex()]);
    }

    /**
     * 修改用户
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionModify($id)
    {
        $model = User::findOne($id);
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            if ($model->load(['User' => $data]) && $model->validate() && $model->save()) {
                return $this->redirect('list', '修改成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('modify', ['model' => $model]);
    }


    /**
     * 禁用/启用用户
     * @param $id
     * @param $st
     * @return \yii\web\Response
     */
    public function actionForbidden($id, $st)
    {
        $model = User::findOne($id);
        if ($st == 0) {
            $model->status = 1;
            VRelation::forbiddenVolume($id);
        } else {
            $model->status = 0;
        }
        $model->save();
        Msg::set('操作成功');
        return $this->redirect(['list']);
    }
}