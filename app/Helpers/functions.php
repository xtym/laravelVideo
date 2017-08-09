<?php
/**
 * Created by PhpStorm.
 * User: ziyun
 * Date: 2017/8/9
 * Time: 21:46
 */

/**
 * 定义常量 判断是否是post请求
 */
define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST'?true:false);

/**
 * 格式化打印函数
 * @param $var
 */
if(!function_exists('p')){
    function p($var){
        echo '<pre>' . print_r($var,true) . '</pre>';
    }
}
