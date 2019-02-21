<?php

namespace vendor\project\database;

use vendor\project\helpers\Constant;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int $auth 用户标识
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
            [['name', 'tel', 'child_name', 'child_age', 'class'], 'required'],
            [['tel'], 'unique', 'message' => '手机号已注册'],
            [
                'tel',
                'match',
                'pattern' => '/^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|17[0-9]{9}$|18[0-9]{9}$/',
                'message' => '手机号格式不正确'
            ],
            [['tel', 'created', 'child_sex', 'child_age', 'status'], 'integer'],
            [['wechat', 'auth'], 'unique'],
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
            'auth' => '用户标识',
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

    /**
     * 获取分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()
            ->page([
                'name' => ['like', 'name'],
                'child_name' => ['like', 'child_name'],
                'class' => ['like', 'class'],
                'tel' => ['like', 'tel'],
                'status' => ['=', 'status'],
            ]);
        foreach ($data['data'] as &$v) {
            $v['status'] = Constant::userStatus()[$v['status']];
            $v['child_sex'] = Constant::sex()[$v['child_sex']];
        }
        return $data;
    }

    //todo**********************  登录接口实现  ***************************

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['auth' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth === $authKey;
    }

}
