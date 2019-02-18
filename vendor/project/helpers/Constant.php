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
}