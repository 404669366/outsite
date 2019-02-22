<?php

namespace vendor\project\database;

use vendor\project\helpers\Msg;
use Yii;

/**
 * This is the model class for table "active".
 *
 * @property string $id
 * @property string $no 活动编号
 * @property string $remark 活动描述
 * @property string $begin_at 活动开始时间
 * @property string $end_at 活动结束时间
 * @property string $limit 人数限制
 */
class Active extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'active';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['begin_at', 'end_at', 'limit', 'no', 'remark'], 'required'],
            [['begin_at', 'end_at', 'limit'], 'integer'],
            [['no'], 'unique'],
            [['no'], 'string', 'max' => 18],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => '活动编号',
            'remark' => '活动描述',
            'begin_at' => '活动开始时间',
            'end_at' => '活动结束时间',
            'limit' => '人数限制',
        ];
    }

    /**
     * 获取参与活动路由
     * @param string $no
     * @param string $rule
     * @return string
     */
    public static function getJoinUrl($no = '', $rule = '/api/active/join.html?no=')
    {
        $domain = Yii::$app->request->hostInfo;
        $domain = str_replace('admin', 'm', $domain);
        $url = $domain . $rule . $no;
        return $url;
    }

    /**
     * 返回分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()->page([
            'no' => ['like', 'no']
        ]);
        foreach ($data['data'] as &$v) {
            $v['can'] = self::canDel($v['id']);
        }
        return $data;
    }

    /**
     * 验证当前活动能否删除
     * @param $id
     * @return bool
     */
    public static function canDel($id)
    {
        if (ARelation::findOne(['active_id' => $id])) {
            return false;
        }
        return true;
    }

    /**
     * 返回参加活动用户
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getJoinUsers($id)
    {
        return ARelation::find()->alias('ar')
            ->leftJoin(User::tableName() . ' u', 'ar.user_id=u.id')
            ->select(['ar.*', 'u.*'])
            ->where(['ar.active_id' => $id])
            ->orderBy('ar.created_at asc')
            ->asArray()->all();
    }

    /**
     * 用户报名活动
     * @param string $no
     * @return bool
     */
    public static function userJoin($no = '')
    {
        Msg::set('活动报名已结束');
        if ($cardInfo = self::isNotFull($no)) {
            Msg::set('您已参与该活动');
            if (!self::isJoin($no)) {
                Msg::set('您没有该活动票券');
                if ($card = self::getUserCardOne()) {
                    $model = new ARelation();
                    $model->user_id = Yii::$app->user->id;
                    $model->active_id = $cardInfo->id;
                    $model->created_at = time();
                    $card->updated_at = time();
                    $card->status = 1;
                    Msg::set('系统错误');
                    if ($model->save() && $card->save()) {
                        Msg::set('报名成功');
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 活动是否满员
     * @param string $no
     * @return bool|null|static
     */
    public static function isNotFull($no = '')
    {
        if ($model = self::findOne(['no' => $no])) {
            $count = ARelation::find()->where(['active_id' => $model->id])->count();
            if ($count < $model->limit) {
                return $model;
            }
        }
        return false;
    }

    /**
     * 验证用户是否加入活动
     * @param string $no
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function isJoin($no = '')
    {
        return ARelation::find()->alias('ar')
            ->leftJoin(Active::tableName() . ' a', 'ar.active_id=a.id')
            ->where(['a.no' => $no, 'ar.user_id' => Yii::$app->user->id])
            ->one();
    }

    /**
     * 获取一张合法的用户活动票券
     * @param int $user_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getUserCardOne($user_id = 0)
    {
        return VRelation::find()->alias('vr')
            ->leftJoin(Volume::tableName() . ' v', 'vr.volume_id=v.id')
            ->where(['vr.user_id' => $user_id ?: Yii::$app->user->id, 'v.type' => 0, 'vr.status' => 0])
            ->andWhere(['<=', 'v.begin_at', time()])
            ->andWhere(['>=', 'v.end_at', time()])
            ->one();
    }
}
