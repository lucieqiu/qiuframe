<?php
//命名空间
namespace app\home\controller;
//测试是否正常加载

//继承houdunwang  croe里面的controller
use houdunwang\croe\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;
use system\model\Hd;
use system\model\Tag;

class IndexController extends Controller
{
    public function index()
    {
        //测试专用
//        echo 'home index index ';
        //测试调用父级index方法，是否正常输出
//        parent::index();
        //这里调用一个View中的没有的make方法就会自动触发__callStatic()
//        View::make();
//        测试加载模板和分配变量
//        View::with();
//直接在Base里面的with方法里面return是不行的，必须在文件经过的每一个方法View类中__callStatic、View类中的runParse、Base里面的with)中都return
//        $test = 'houdunwang';
//        return View::with(compact ('test','hd'))->make('welcome');


        //测试Model(操作数据库)

//        $data = Model::query('select * from student');
//        p($data);


        //3.23号
        //1.Model
        //测试加载配置项文件c函数c()(配置项所有文件)，c（database）（database里面的所有文件），c（database.name)(database里面的某一项数据)
        //配置项文件c在helper里面进行封装，为了方便以后调用
//        $res = c();
//        p($res);
//        $res = c('database');
//        p($res);
//        $res = c('database.host');
//        p($res);

        //2.将测试完的c函数替换到houdunwang/model/Base.php里面
//        $data = Model::query('select * from student');
//        p($data);
//        Hd::find(1);
//        Tag::find(1);
//        date('y/m/d/h/i/s');
//        p(date('y/m/d/h/i/s'));
        //测试where查询条件
//        $data = Hd::where('cid=1');
//        p($data);

//        $data = Hd::get();
//        $data = Hd::where();
//        $data = Tag::orderBy('tid desc')->get();
//        $data = Tag::name('tname')->get();
//        $data = Tag::limit(2)->get();
//        p(Tag::groupBy('tname'));

        $data = Tag::groupBy('tname')->get();
//        echo 1;
        p($data);
    }


    public function add()
    {
        //        echo 'home index add';
        //2.测试Controller 书写的message和setRedirect方法
//        $this->setRedirect()->message('添加成功');


    }
}