<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2019/2/20
 * Time: 16:13
 */

namespace app\controllers\volume;


use app\controllers\basis\CommonController;
use vendor\project\database\Volume;
use vendor\project\helpers\Constant;
use vendor\project\helpers\Msg;

class VolumeController extends CommonController
{
    /**
     * 活动券列表页
     * @return string
     */
    public function actionList()
    {
        return $this->render('list', ['types' => Constant::volumeType()]);
    }

    /**
     * 活动券列表页数据
     * @return string
     */
    public function actionData()
    {
        return $this->rTableData(Volume::getPageData());
    }

    /**
     * 添加活动券
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new Volume();
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            $data['begin_at'] = $data['begin_at'] ? strtotime($data['begin_at']) : '';
            $data['end_at'] = $data['end_at'] ? strtotime($data['end_at']) : '';
            $data['created_at'] = time();
            if ($model->load(['Volume' => $data]) && $model->validate() && $model->save()) {
                return $this->redirect(['list'], '添加成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('add');
    }

    /**
     * 修改活动券
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $model = Volume::findOne($id);
        if (\Yii::$app->request->isPost) {
            $data = \Yii::$app->request->post();
            $data['begin_at'] = $data['begin_at'] ? strtotime($data['begin_at']) : '';
            $data['end_at'] = $data['end_at'] ? strtotime($data['end_at']) : '';
            if ($model->load(['Volume' => $data]) && $model->validate()) {
                Msg::set('该活动券不能修改');
                if (Volume::exist($id)) {
                    $model->save();
                    Msg::set('修改成功');
                }
                return $this->redirect(['list']);
            }
            Msg::set($model->errors());
        }
        return $this->render('edit', ['model' => $model]);
    }

    /**
     * 删除活动券
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        Msg::set('该活动券不能删除');
        if (Volume::exist($id)) {
            $model = Volume::findOne($id);
            $model->delete();
            Msg::set('删除成功');
        }
        return $this->redirect(['list']);

    }

    /**
     * 发放活动券
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionGrant($id)
    {
        if (Volume::timeout($id)) {
            $model = Volume::findOne($id);
            if (\Yii::$app->request->isPost) {
                $re = Volume::grant(\Yii::$app->request->post('users', ''), \Yii::$app->request->post('num', 1), $id);
                Msg::set('共检测到' . $re['allNum'] . '个用户,成功发放' . $re['insertNum'] . '个用户');
                if ($re['result']) {
                    return $this->render('result', ['re' => $re]);
                }
            }
            return $this->render('grant', ['model' => $model]);
        }
        return $this->redirect(['list'], '活动券已过期');
    }
}