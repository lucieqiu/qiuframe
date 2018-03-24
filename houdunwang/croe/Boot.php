<?php
//命名空间
namespace houdunwang\croe;

/**
 * 框架启动类
 * Class Boot
 * @package houdunwang\croe
 */
class Boot
{
    public static function run()
    {
        //测试代码是否正常运行到这里
//        echo 'run';//如果不加载vendor/autolot文件会报错
        //测试助手函数是否正常加载
//        p(1);//正常加载运行
        //实例化init类
        self::init();
//        实例化appRun类
        self::appRun();

    }

    /**
     * 执行应用（app，application）
     * 运行app类
     */
    public static function appRun()
    {
        //测试是否正常运行
//        echo 4;
        /**
         * 在app\home\controller\IndexController里面创建两个类在这里进行测试
         * 直接这样进行实例化会报错：类找不见
         * 解决方法：在ventor里的autolot里面进行配置，修改完配置文件之后执行：composer dump即可，然后刷新浏览器即可正常测试
         */
//        (new \app\home\controller\IndexController())->index();//Uncaught Error: Class '\app\home\controller\IndexController' not found in

//        (new \app\home\controller\ArticleController())->add();//报错  Uncaught Error: Class '\app\home\controller\IndexController' not found in

//        (new \app\home\controller\ArticleController())->add();//你好世界
//        (new \app\home\controller\ArticleController())->hd();//hello word


        /**
         * 我们会实例化不同的类，调用不同的方法，所以方法和类是不可以写死的
         * 以往我们会通过地址栏参数的变化，控制访问不同的类，调用不同的方法，如下：
         * ?m=admin&c=index&a=add(在这里m=模块，c=控制器类，a=方法)
         * 我们现在也是通过地址栏传参来改变页面，只不过一次就好了，如：
         * ?s=admin/index/app(我们会使用该方法)
         */

         //判断地址栏里面是否传参
        if (isset($_GET['s'])){
            //吧传的参赋值给$s,为了下面进行拆分
            $s = $_GET['s'];

            //将字符串拆分成组
            $info = explode('/',$s);
//            p($info);die;//打印出来的东西是个数组，如下所示：
//            Array
//            (
//                [0] => home
//                [1] => index
//            [2] => index
//)
            $m = $info[0];
            $c = $info[1];
            $a = $info[2];
            //当地址栏第没有参数的时候就默认走下面的内容
        }else{
            $m = 'home';
            $c = 'index';
            $a = 'index';
        }

        define('MODULE',$m);
        define('CONTROLLER',strtolower($c));
        define('ACTION',$a);
        //组合新的路径，使之跟随get参数里面的值的变化而变化
        $controller = '\app\\' . $m . '\controller\\' . ucfirst($c) .'Controller';

//        (new $controller())->$a();
//        (new \app\admin\controller\IndexController())->index();
        //回调函数（系统函数）运行加载快，
//        call_user_func_array([实例化的类,方法],[要传的参数]);
        call_user_func_array([new $controller,$a],[]);
    }

    /**
     * 初始化
     * 声明头部，时区设置，开区session等
     */
    public static function init()
    {
        //测试方法时候正常运行
//        echo 11;

        //头部
        header ('Content-type:text/html;charset=utf8');
        //设置时区
        date_default_timezone_set(c('time.time'));

//        p(c('time.time'));
        //开启session（判断下面session是否开启，如果有session_id的存在，就说明已开启，没有则执行session_start,开启session）
        session_id() || session_start();
    }

}
