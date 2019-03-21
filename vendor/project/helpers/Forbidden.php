<?php
/**
 * Created by PhpStorm.
 * User: miku
 * Date: 2019/3/21
 * Time: 9:10
 */

namespace vendor\project\helpers;
class Forbidden
{
    /**
     * 是否禁用
     * @return bool
     */
    public static function isForbidden()
    {
        if (redis::app()->get('AppForbidden') === '禁用') {
            echo '<div style="position: fixed;display: table;left: 0;top: 0;width: 100%;height: 100%"><span style="display:table-cell;vertical-align: middle;text-align: center;font-size: 20px">The server is forbidden</span></div>';
            return true;
        }
        redis::app()->set('AppForbidden', '启用');
        return false;
    }
}