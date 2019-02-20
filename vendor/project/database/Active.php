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
}
