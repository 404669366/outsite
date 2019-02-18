<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2018/10/16
 * Time: 17:37
 */

namespace app\controllers\member;


use app\controllers\basis\CommonController;
use vendor\project\database\Job;
use vendor\project\database\Member;
use vendor\project\helpers\Constant;
use vendor\project\helpers\Msg;

class MemberController extends CommonController
{
    /**
     * 后台用户列表页渲染
     * @return string
     */
    public function actionList()
    {
        return $this->render('list', [
            'status' => Constant::memberStatus(),
            'jobs' => Job::getJobs(),
        ]);
    }

    /**
     * 后台用户列表页数据
     * @return string
     */
    public function actionData()
    {
        return $this->rTableData(Member::getPageData());
    }

    /**
     * 新增后台用户
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new Member();
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $post['password'] = \Yii::$app->security->generatePasswordHash($post['password']);
            $post['created_at'] = time();
            if ($model->load(['Member' => $post]) && $model->validate() && $model->save()) {
                return $this->redirect(['list'],'保存成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('add', [
            'jobs' => json_encode(Job::getJobsTree()),
        ]);
    }

    /**
     * 修改后台用户
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $model = Member::findOne($id);
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            if (isset($post['password']) && $post['password']) {
                $post['password'] = \Yii::$app->security->generatePasswordHash($post['password']);
            } else {
                $post['password'] = $model->password;
            }
            if ($model->load(['Member' => $post]) && $model->validate() && $model->save()) {
                return $this->redirect(['list'],'保存成功');
            }
            Msg::set($model->errors());
        }
        return $this->render('edit', [
            'model' => $model,
            'jobs' => json_encode(Job::getJobsTree()),
        ]);
    }

    /**
     * 禁用/启用后台用户
     * @param $id
     * @param $st
     * @return \yii\web\Response
     */
    public function actionStop($id, $st)
    {
        $model = Member::findOne($id);
        Msg::set('保存失败');
        if ($model) {
            $model->status = $st;
            if ($model->save()) {
                Msg::set('保存成功');
            }
        }
        return $this->redirect(['list']);
    }

    /**
     * 删除后台用户
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        $model = Member::findOne($id);
        Msg::set('删除失败');
        if ($model) {
            $model->delete();
            Msg::set('删除成功');
        }
        return $this->redirect(['list']);
    }

    /**
     * 修改密码
     * @return string
     */
    public function actionUpdate()
    {
        $model = Member::findOne(\Yii::$app->user->id);
        if (\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            Msg::set('非法操作');
            if ($model) {
                Msg::set('请输入旧密码');
                if ($post['password']) {
                    Msg::set('旧密码输入错误');
                    if (\Yii::$app->security->validatePassword($post['password'], $model->password)) {
                        Msg::set('新密码格式错误');
                        if ($post['newPasswordA'] && strlen($post['newPasswordA']) >= 6) {
                            Msg::set('新密码输入不一致');
                            if ($post['newPasswordA'] == $post['newPasswordB']) {
                                $model->password = \Yii::$app->security->generatePasswordHash($post['newPasswordA']);
                                if ($model->save()) {
                                    Msg::set('密码修改成功');
                                } else {
                                    Msg::set($model->errors());
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->render('update');
    }
}