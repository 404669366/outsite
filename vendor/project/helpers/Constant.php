<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2018/10/16
 * Time: 14:29
 */

namespace vendor\project\helpers;


class Constant
{
    /**
     * 权限类型
     * @return array
     */
    public static function powerType()
    {
        return [
            1 => '菜单',
            2 => '按钮',
            3 => '接口',
        ];
    }

    /**
     * 后台用户状态
     * @return array
     */
    public static function memberStatus()
    {
        return [
            1 => '启用',
            2 => '禁用',
        ];
    }

    /**
     * 活动券类型
     * @return array
     */
    public static function volumeType()
    {
        return [
            0 => '活动报名凭证',
            1 => '活动优惠券',
        ];
    }

    /**
     * 活动劵使用状态
     * @return array
     */
    public static function volumeStatus()
    {
        return [
            0 => '未使用',
            1 => '已使用',
            2 => '已禁用',
        ];
    }

}