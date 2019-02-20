<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/2/20
 * Time: 9:47
 */

namespace app\controllers\active;


use app\controllers\basis\CommonController;
use vendor\project\database\Active;
use vendor\project\helpers\Msg;

class ActiveController extends CommonController
{
    /**
     * 活动列表页
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 活动列表页数据
     * @return string
     */
    public function actionData()
    {
        return $this->rTableData(Active::getPageData());
    }

    /**
     * 创建活动
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            $data['begin_at'] = $data['begin_at'] ? strtotime($data['begin_at']) : '';
            $data['end_at'] = $data['end_at'] ? strtotime($data['end_at']) : '';
            $model = new Active();
            if ($model->load(['Active' => $data]) && $model->validate() && $model->save()) {
                return $this->redirect(['detail?id=' . $model->id], '创建成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('add');
    }

    /**
     * 活动详情页
     * @param $id
     * @return string
     */
    public function actionDetail($id)
    {
        return $this->render('detail', [
            'model' => Active::findOne($id),
            'users' => Active::getJoinUsers($id)
        ]);
    }

    /**
     * 删除活动
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        Msg::set('已有人参与活动,不能删除');
        if (Active::canDel($id)) {
            Active::findOne($id)->delete();
            Msg::set('删除成功');
        }
        return $this->redirect(['list']);
    }
}