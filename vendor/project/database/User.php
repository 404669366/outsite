<?php

namespace vendor\project\database;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $tel 用户电话
 * @property string $wechat 微信ID
 * @property string $name 家长姓名
 * @property string $child_name 学生姓名
 * @property int $child_sex 学生性别
 * @property int $child_age 学生年龄
 * @property string $class 班级
 * @property int $status 账号状态
 * @property string $created 创建时间
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tel'], 'unique', 'message' => '手机号已注册'],
            [['tel', 'created', 'child_sex', 'child_age', 'status'], 'integer'],
            [['wechat'], 'unique'],
            [['wechat'], 'string', 'max' => 80],
            [['name', 'child_name', 'class'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tel' => '用户电话',
            'wechat' => '微信ID',
            'created' => '创建时间',
            'child_sex' => '学生性别',
            'child_age' => '学生年龄',
            'child_name' => '学生姓名',
            'name' => '家长姓名',
            'class' => '班级',
            'status' => '账号状态',
        ];
    }

    //todo**********************  登录接口实现  ***************************

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['password' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->password;
    }

    public function validateAuthKey($authKey)
    {
        return $this->password === $authKey;
    }

}
