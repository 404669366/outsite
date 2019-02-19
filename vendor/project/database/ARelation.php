<?php

namespace vendor\project\database;

use Yii;

/**
 * This is the model class for table "a_relation".
 *
 * @property string $id
 * @property string $user_id 家长id
 * @property string $active_id 活动id
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
            [['user_id', 'active_id'], 'integer'],
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
        ];
    }
}
