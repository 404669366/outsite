<?php

namespace vendor\project\database;

use Yii;

/**
 * This is the model class for table "v_relation".
 *
 * @property string $id
 * @property string $user_id 家长id
 * @property string $volume_id 活动券id
 * @property int $status 活动券使用状态0未使用1已使用2已禁用
 * @property string $updated_at 更新时间
 */
class VRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'v_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'volume_id', 'status', 'updated_at'], 'integer'],
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
            'volume_id' => '活动券id',
            'status' => '活动券使用状态0未使用1已使用2已禁用',
            'updated_at' => '更新时间',
        ];
    }
}
