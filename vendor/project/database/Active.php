<?php

namespace vendor\project\database;

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
            [['begin_at', 'end_at', 'limit'], 'integer'],
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
}
