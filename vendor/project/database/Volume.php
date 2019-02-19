<?php

namespace vendor\project\database;

use Yii;

/**
 * This is the model class for table "volume".
 *
 * @property string $id
 * @property string $no 编号
 * @property int $type 活动券类型0活动报名凭证1活动优惠券
 * @property string $money 金额
 * @property string $created_at 创建时间
 * @property string $begin_at 开始时间
 * @property string $end_at 截止时间
 * @property string $remark 备注
 */
class Volume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'volume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'created_at', 'begin_at', 'end_at'], 'integer'],
            [['no'], 'string', 'max' => 18],
            [['money'], 'string', 'max' => 10],
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
            'no' => '编号',
            'type' => '活动券类型0活动报名凭证1活动优惠券',
            'money' => '金额',
            'created_at' => '创建时间',
            'begin_at' => '开始时间',
            'end_at' => '截止时间',
            'remark' => '备注',
        ];
    }
}
