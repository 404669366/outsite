<?php

namespace vendor\project\database;

use Yii;

/**
 * This is the model class for table "a_relation".
 *
 * @property string $id
 * @property string $user_id 家长id
 * @property string $active_id 活动id
 * @property string $created_at 创建时间
 */
class ARelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'a_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'active_id'], 'required'],
            [['user_id', 'active_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '家长id',
            'active_id' => '活动id',
            'created_at' => '创建时间',
        ];
    }

    /**
     * 返回用户参与活动
     * @param int $user_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getUserActive($user_id = 0)
    {
        return self::find()->alias('ar')
            ->leftJoin(Active::tableName() . ' a', 'ar.active_id=a.id')
            ->select(['a.no', 'a.remark', 'a.begin_at', 'a.end_at', 'ar.created_at'])
            ->where(['user_id' => $user_id ?: Yii::$app->user->id])
            ->asArray()->all();
    }
}
