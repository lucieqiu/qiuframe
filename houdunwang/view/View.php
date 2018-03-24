<?php

namespace houdunwang\view;

class View
{
    //当调用一个不存在的方法是就会自动触发该函数
    /**
     * @param $name 找不到的方法名
     * @param $arguments  该方法的参数
     */
    public function __call($name, $arguments)
    {
        return self::runParse($name, $arguments);


    }

    //当调用一个不存在的静态方法时就会触发该函数

    /**
     * @param $name  找不到的方法名
     * @param $arguments  该方法的参数
     */
    public static function __callStatic($name, $arguments)
    {
        //测试是否调到view里的方法
//        echo 2;//2
       return self::runParse($name, $arguments);

    }

    /**
     * @param $name  方法名
     * @param $arguments  该方法参数
     */
    private static function runParse($name, $arguments)
    {
        //测试是否正常输出
//        echo 1;//1
//        p($arguments);//打印出的结果是数组
        //接受Base中$name中(with/make)的返回值
        return call_user_func_array([new Base(), $name], $arguments);
    }
}