<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/18
 * Time: 15:55
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}