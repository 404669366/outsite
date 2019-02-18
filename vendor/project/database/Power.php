<?php

namespace vendor\project\database;

use vendor\project\helpers\Constant;
use Yii;

/**
 * This is the model class for table "power".
 *
 * @property string $id
 * @property string $no 权限标识
 * @property int $type 权限类型 1菜单2按钮3接口
 * @property string $name 权限名
 * @property string $url 权限路由
 * @property int $sort 排序
 * @property int $last 上级权限
 */
class Power extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'power';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'sort', 'last'], 'integer'],
            [['url'], 'unique'],
            [['no'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 30],
            [['url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => '权限标识',
            'type' => '权限类型 1菜单2按钮3接口',
            'name' => '权限名',
            'url' => '权限路由',
            'sort' => '排序',
            'last' => '上级权限',
        ];
    }

    /**
     * 分页数据
     * @return mixed
     */
    public static function getPageData()
    {
        $data = self::find()->alias('p1')
            ->leftJoin(self::tableName() . ' p2', 'p1.last=p2.id')
            ->select(['p1.*', 'p2.name as lastName'])
            ->page([
                'type' => ['like', 'p1.type'],
                'name' => ['like', 'p1.name'],
                'last' => ['like', 'p2.name'],
            ]);
        foreach ($data['data'] as &$v) {
            $v['type'] = Constant::powerType()[$v['type']];
        }
        return $data;
    }

    /**
     * 返回顶级权限
     * @param bool $notSelf
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getTopPowers($notSelf = false)
    {
        $data = self::find()->where(['last' => 0]);
        if ($notSelf) {
            $data->andWhere(['<>', 'id', $notSelf]);
        }
        return $data->select(['name', 'id'])->asArray()->all();
    }

    /**
     * 返回权限树
     * @return array
     */
    public static function getPowerTree()
    {
        $data = [];
        $tops = self::getTopPowers();
        foreach ($tops as $v) {
            $one['key'] = $v['name'];
            $one['value'] = $v['id'];
            $one['son'] = self::find()->where(['last' => $v['id']])
                ->select(['name as key', 'id as value'])
                ->asArray()->all();
            array_push($data, $one);
        }
        return $data;
    }

    /**
     * 获取菜单
     * @param string $ids
     * @return string
     */
    public static function getMenu($ids = '')
    {
        if ($ids) {
            $menu = '';
            $ids = explode(',', $ids);
            $powers = self::find()->where(['id' => $ids, 'last' => 0, 'type' => 1])
                ->select(['id', 'name', 'url'])
                ->orderBy('sort desc')
                ->asArray()->all();
            foreach ($powers as $v) {
                $menu .= "<li><a href='#'><span class='nav-label'>{$v['name']}</span><span class='fa arrow'></span></a>";
                $sons = self::find()->where(['last' => $v['id'], 'id' => $ids, 'type' => 1])
                    ->select(['name', 'url'])
                    ->orderBy('sort desc')
                    ->asArray()->all();
                $menu .= '<ul class="nav nav-second-level">';
                foreach ($sons as $son) {
                    $menu .= "<li><a class='J_menuItem' href='{$son['url']}'>{$son['name']}</a></li>";
                }
                $menu .= '</ul>';
            }
            return $menu;
        }
        return '';
    }

    /**
     * 获取Root菜单
     * @return string
     */
    public static function getRootMenu()
    {
        $menu = '';
        $powers = self::find()->where(['last' => 0, 'type' => 1])
            ->select(['id', 'name', 'url'])
            ->orderBy('sort desc')
            ->asArray()->all();
        foreach ($powers as $v) {
            $menu .= "<li><a href='#'><span class='nav-label'>{$v['name']}</span><span class='fa arrow'></span></a>";
            $sons = self::find()->where(['last' => $v['id'], 'type' => 1])
                ->select(['name', 'url'])
                ->orderBy('sort desc')
                ->asArray()->all();
            $menu .= '<ul class="nav nav-second-level">';
            foreach ($sons as $son) {
                $menu .= "<li><a class='J_menuItem' href='{$son['url']}'>{$son['name']}</a></li>";
            }
            $menu .= '</ul>';
        }
        return $menu;
    }

    /**
     * 查询拥有对应权限的用户数量
     * @param string $no
     * @return int|string
     */
    public static function getMemberCountByPower($no = '')
    {
        if ($power = self::findOne(['no' => $no])) {
            return Member::find()->alias('m')
                ->leftJoin(Job::tableName() . ' j', 'm.job_id=j.id')
                ->where('find_in_set(' . $power->id . ',j.powers)')
                ->count();
        }
        return 0;
    }

    /**
     * 判断用户是否有权限
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    public static function pass()
    {
        if (!in_array(Yii::$app->user->identity->username, \Yii::$app->params['rootName'])) {
            if ($rule = self::findOne(['url' => '/' . Yii::$app->controller->getRoute()])) {
                return Job::find()->where(['id' => Yii::$app->user->identity->job_id])
                    ->andWhere('find_in_set(' . $rule->id . ',powers)')
                    ->one();
            }
        }
        return true;
    }

}
