<?php

namespace vendor\project\database;

use vendor\project\helpers\Constant;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "member".
 *
 * @property string $id
 * @property string $username 用户名
 * @property string $tel 手机号
 * @property string $password 密码
 * @property string $job_id 职位id
 * @property int $status 状态 1启用 2禁用 3删除
 * @property string $created_at
 */
class Member extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'tel'], 'unique'],
            [
                'tel',
                'match',
                'pattern' => '/^13[0-9]{9}$|14[0-9]{9}$|15[0-9]{9}$|17[0-9]{9}$|18[0-9]{9}$/',
                'message' => '手机号格式不正确'
            ],
            [['username', 'tel', 'job_id'], 'required'],
            [['job_id', 'status', 'created_at'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['tel'], 'string', 'max' => 11],
            [['password'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'tel' => '手机号',
            'password' => '密码',
            'job_id' => '职位',
            'status' => '状态 1启用 2禁用 3删除',
            'created_at' => 'Created At',
        ];
    }

    /**
     * 用户名或手机号登录
     * @param string $account
     * @param string $pwd
     * @return bool
     */
    public static function accountLogin($account = '', $pwd = '')
    {
        $member = self::findOne(['username' => $account, 'status' => 1]);
        if (!$member) {
            $member = self::findOne(['tel' => $account, 'status' => 1]);
        }
        if ($member) {
            if (Yii::$app->security->validatePassword($pwd, $member->password)) {
                Yii::$app->user->login($member, 3 * 60 * 60);
                return true;
            }
        }
        return false;
    }

    /**
     * 用户管理分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()->alias('m')
            ->leftJoin(Job::tableName() . ' j', 'm.job_id=j.id')
            ->where(['<>', 'm.job_id', 0])
            ->select(['m.*', 'j.job'])
            ->page([
                'username' => ['like', 'm.username'],
                'tel' => ['like', 'm.tel'],
                'job' => ['=', 'j.id'],
                'status' => ['=', 'm.status'],
            ]);
        foreach ($data['data'] as &$v) {
            $v['transStatus'] = Constant::memberStatus()[$v['status']];
            $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
        }
        return $data;
    }

    /**
     * 根据职位获取用户
     * @param int $job_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getMemberByJob($job_id = 0)
    {
        return self::find()->where(['job_id' => $job_id])
            ->select(['username', 'id'])->asArray()->all();
    }

    /**
     *  验证用户是否root账户
     * @param int $user_id
     * @return bool
     */
    public static function isRoot($user_id = 0)
    {
        if (self::findOne(['id' => $user_id, 'job_id' => 0])) {
            return true;
        }
        return false;
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
