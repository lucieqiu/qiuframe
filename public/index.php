<?php
/**
 * 单一入口文件
 */
require_once '../vendor/autoload.php';
//这个时候会报错，因为json里面添加autoload要加载的东西
\houdunwang\croe\Boot::run();