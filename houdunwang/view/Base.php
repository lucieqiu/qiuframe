<?php

namespace houdunwang\view;

use houdunwang\model\Model;

class Base
{
    private $file;//模板文件
    private $data = [];//储存数据
    /**
     * 加载模板
     */
    public function make($tpl ='')
    {
       //测试是否正常调用
//        echo 'make';//make

//        include './view/welcome.php';//正常加载
//        p(MODULE);//home
//        p(CONTROLLER);//index
//        p(ACTION);//index
        //判断$tpl里面是否有数据，如果有就走本身，如果没有就走ACTION定义的页面
        $tpl = $tpl ? :ACTION;
        //重新组合路径，使之随意变换组合路径
        $this->file='../app/'.MODULE.'/view/'.CONTROLLER.'/'.$tpl.'.php';
        return $this;
    }

    /**
     * 分配变量
     */
    public function with($var = []){
        //测试是否正常加载数据
//        echo 'with';
//        p($var);
//        extract($var);
        $this->data =$var;
        //返回给View里面的runParse方法
        return $this;
    }

    /**
     * 当输出一个对象的时候就会自动该函数
     * @return string
     */
    public function __toString()
    {
        //取出结果集
       extract($this->data);

       if (!is_null($this->file))
       {
           include $this->file;
       }
        return '';
    }
}