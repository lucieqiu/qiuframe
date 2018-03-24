<?php
namespace houdunwang\model;


class Model
{
    public function __call($name, $arguments)
    {
        return self::runParse($name, $arguments);
    }

    public static function __callStatic ($name, $arguments)
    {
        return self::runParse($name, $arguments);
    }

    private static function runParse($name, $arguments)
    {
        $table= get_called_class();
//        p($table);die;
        return call_user_func_array([new Base($table),$name],$arguments) ;
    }
}