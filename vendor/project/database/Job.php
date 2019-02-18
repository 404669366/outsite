<?php

namespace vendor\project\database;

use vendor\project\helpers\Helper;
use vendor\project\helpers\redis;
use Yii;

/**
 * This is the model class for table "job".
 *
 * @property string $id
 * @property string $job 职位名
 * @property string $last 上级
 * @property string $powers 拥有权限
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last'], 'integer'],
            [['job'], 'string', 'max' => 30],
            [['powers'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job' => '职位名',
            'last' => '上级',
            'powers' => '拥有权限',
        ];
    }

    /**
     * 分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()->alias('j1')
            ->leftJoin(self::tableName() . ' j2', 'j1.last=j2.id')
            ->select(['j1.*', 'j2.job as lastJob'])
            ->page([
                'job' => ['like', 'j1.job'],
                'last' => ['like', 'j2.job'],
            ]);
        foreach ($data['data'] as &$v) {
            $v['powers'] = explode(',', $v['powers']);
            $v['powers'] = Power::find()
                ->where(['id' => $v['powers']])
                ->select(['name'])
                ->asArray()->all();
            $v['powers'] = array_column($v['powers'], 'name');
            $v['powers'] = Helper::arrToStr($v['powers'], ' , ', '10');
        }
        return $data;
    }

    /**
     * 返回顶级职位
     * @param bool $notSelf
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getTopJobs($notSelf = false)
    {
        $data = self::find()->where(['last' => 0]);
        if ($notSelf) {
            $data->andWhere(['<>', 'id', $notSelf]);
        }
        return $data->select(['id', 'job'])->asArray()->all();
    }

    /**
     * 返回职位树
     * @return array
     */
    public static function getJobsTree()
    {
        $data = [];
        $tops = self::getTopJobs();
        foreach ($tops as $v) {
            $one['key'] = $v['job'];
            $one['value'] = $v['id'];
            $one['son'] = self::find()->where(['last' => $v['id']])
                ->select(['id as value', 'job as key'])
                ->asArray()->all();
            array_push($data, $one);
        }
        return $data;
    }

    /**
     * 返回所有职位
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getJobs()
    {
        return self::find()->select(['id', 'job'])->asArray()->all();
    }

    /**
     * 更新权限缓存
     * @param bool $isDelete
     */
    public function updateRule($isDelete = false)
    {
        $key = \Yii::$app->params['entryName'] . 'BackendMenu';
        if ($isDelete) {
            redis::app()->hDel($key, $isDelete);
        } else {
            $menu = Power::getMenu($this->powers);
            redis::app()->hSet($key, $this->id, $menu);
        }
    }

}
