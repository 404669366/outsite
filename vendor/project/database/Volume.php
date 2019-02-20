<?php

namespace vendor\project\database;

use vendor\project\helpers\Constant;
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
            [['no', 'type', 'remark', 'begin_at', 'end_at'], 'required'],
            [['type', 'created_at', 'begin_at', 'end_at'], 'integer'],
            [['no'], 'unique'],
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

    /**
     * 获取分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()
            ->page([
                'type' => ['=', 'type'],
                'no' => ['=', 'no'],
            ]);
        foreach ($data['data'] as &$v) {
            $v['type'] = Constant::volumeType()[$v['type']];
        }
        return $data;
    }

    /**
     * 查看活动券是否发放
     * @param $id
     * @return bool
     */
    public static function exist($id)
    {
        if (VRelation::findOne(['volume_id' => $id])) {
            return false;
        }
        return true;
    }
}
