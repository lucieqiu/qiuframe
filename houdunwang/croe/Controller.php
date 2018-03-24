<?php

namespace houdunwang\croe;
class Controller
{

    //测试页面是否被正常加载
//    public function index()
//    {
//        echo 'houdunwang croe controller index';
//   }

    /**
     * 消息提示
     * @param $msg  消息内容
     */
    public function message($msg)
    {
//        p($msg);
        //加载模板文件
    include './view/message.php';

    }

    /**
     * 重定向（制定跳转页面）
     * @param string $url 接受要跳转的地址
     * @return $this 对象
     */
    public function setRedirect($url='')
    {
        if ($url){
            //制定跳转地址
            $this->url = $url;
        }else{
            //跳转回历史记录
            $this->url = 'javascript:history.back();';
        }
        return $this;
    }

}