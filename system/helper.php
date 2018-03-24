<?php
/**
 * 打印函数
 * @param $var    打印的变量
 */
function p($var)
{
    echo '<pre style="width: 100%;padding: 5px;background: #CCCCCC;border-radius: 5px">';
    if (is_bool($var) || is_null($var)) {
        var_dump($var);
    } else {
        print_r($var);
    }
    echo '</pre>';
}

/**
 * 定义常量:IS_POST
 * 将侧是否为post请求
 */
define('IS_POST', $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);

//配置项文件的加载函数c（config）
function c($var = null)
{

    //当c=null的时候就会，调用c函数就会加载所有配置项
    if (is_null($var)) {

        //1.首先要扫描config目录里面的所有文件
        $files = glob('../system/config/*');
//        p($files);
//        Array
        //打印结果
//        (
//            [0] => ../system/config/database.php
//            [1] => ../system/config/view.php
//)
        //声明一个空数组，用来存储最终结果
        $data = [];
        //训话$files里面的数据
        foreach ($files as $file) {
//            p($file);//../system/config/database.php
            //加载文件内容
            $content = include $file;
//            p($content);
            //打印结果
            //Array
//            (
//            [host] => 127.0.0.1
//            [name] => c91
//            [user] => root
//            [pass] => root
//)
//          Array
//        (
//           [suffix] => php
//         )

            //2.获取文件名，不要后缀
            //获得文件名
            $fileName = basename($file);
//            p($fileName);//database.php
            $position = strpos($fileName, '.php');
            //获得后缀.php的位置
//            p($position);//8
            //前面已经得出后缀的位置，开始截取，从0号元素开始截取到$position(文件后缀的位置)
            //获取文件名
            $index = substr($fileName, 0, $position);
//            p($index);//database
            $data[$index] = $content;
//            p($data);
//          结果  Array
//            (
//                [database] => Array
//                (
//             [host] => 127.0.0.1
//            [name] => c91
//            [user] => root
//            [pass] => root
//        )
            return $file;
        }
        return $data;
    }
    $info = explode('.', $var);
//    p($info);die();//database
    //如果$info==1就说明调用c（’database‘）的时候，就会加载database里面的所有数据
    if (count($info)==1){
        $file = '../sytem/config/'.$var.'.php';
//        p($file);
        return is_file($file)? include $file :null;
    }
    //如果当$info==2,就说明调用c（database.name),只加载database里的name这一条数据
    if (count($info)==2){
        $file = '../system/config/'.$info[0].'.php';
//p($info);
        if (is_file($file)){
            $data = include $file;
//            p($data);
            return isset($data[$info[1]]) ? $data[$info[1]] :null;
        }else{
            return null;
        }
    }

}






























