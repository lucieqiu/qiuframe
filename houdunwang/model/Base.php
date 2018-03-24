<?php

namespace houdunwang\model;

use PDO;
use Exception;

class Base
{
    private static $pdo = null;
    private $table;//要操作的数据表
    private $where = '';//where查询条件
    private $order = '';//排序
    private $name;//搜索名字
    private $limit;//截取
    private $group;//分组

    public function __construct($table)
    {

        self::connect();

//        p($table);die;//system\model\Tag
        //进行字符串的截取，用于后面sql语句的拼接
        $this->table = strtolower(ltrim(strrchr($table, '\\'), '\\'));
//        p($this->table);//tag
    }

    /**
     * where 条件查询
     * @param $where
     * @return $this
     */
    public function where($where)
    {
//        echo 1;
//        p($where);//cid=1
        //进行where条件的拼接
        $this->where = $where ? ' where ' . $where : '';
//        p($this->where);die;
        return $this;
    }

    /**
     * 表单排序
     * @param $order //排序
     * @return $this
     */
    public function orderBy($order)
    {
//        echo 1;
        $this->order = $order ? ' order by ' . $order : '';
        return $this;
    }

    /**
     * 按照名称进行搜索
     * @param $name //名称
     * @return $this
     */
    public function name($name)
    {

        $this->name = $name ? ' ' . $name . ' ' : null;
        return $this;
    }

    /**
     * 截取
     * @param $limit  截取
     * @return $this
     */
    public function limit($limit)
    {
//        echo 1;die
        $this->limit = $limit ? ' limit ' . $limit : '';
        return $this;
    }

    /**
     * 分组
     * @param $group   分组
     * @return $this
     */
        public function groupBy($group)
    {
//        echo 1;
//        return 1;
            $this->$group = $group ? ' group by ' .$group : '';
//            p(1);
//            p($this->$group);die;
            return $this;
    }


    /**
     * 获取所有数据
     * @return array
     * @throws Exception
     */
    public function get()
    {
//        echo 1;die;
        if (is_null($this->name)) {
            $sql = 'select * from ' . $this->table . $this->where . $this->group . $this->order . $this->limit;
        } else {
            $sql = 'select ' . $this->name . ' from ' . $this->table . $this->where . $this->group . $this->order . $this->limit;
        }

//        p($sql);die;
//        p($sql);die;
        return $this->query($sql);

    }

    /**
     * 根据主键获得一条数据
     * @param $pri  主键值
     * @return mixed
     * @throws Exception
     */
    public function find($pri)
    {
//        echo 1;die;
//        p($pri);
        //获取当前要操作数据的主键
        $priField = $this->getPriField();
//        p($priField);
        $sql = "select * from " . $this->table . ' where ' . $priField . '=' . $pri;
//         p($sql);//select * from hd where id=1
        return current($this->query($sql));
    }


    /**
     * 获取数据表里的主键
     * @return mixed
     * @throws Exception
     */
    private function getPriField()
    {
//        echo 1;die;
        //查看表结构
//        $sql= 'desc '.$this->table;
//        p($sql);//desc hd
        //
        $res = $this->query('desc ' . $this->table);
//        p($res);die;
        //循环表数据
        foreach ($res as $v) {
            //判断$v是否=pri（主键）
            if ($v['Key'] == 'PRI') {
                //把结果反出去
                return $v['Field'];
            }

        }
    }

    /**
     * 连接数据库
     * @throws Exception
     */
    private static function connect()
    {
//        echo 2;die;
//        print_r(c('database.host')) ;die;
        if (is_null(self::$pdo)) {
            try {

                $dsn = 'mysql:host=' . c('database.host') . ';dbname=' . c('database.name');
                self::$pdo = new PDO($dsn, c('database.user'), c('database.pass'));
                self::$pdo->query('set name utf8');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                echo 3;die;
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

        }

    }


    /**
     *执行有结果集的操作(select)
     * @param $sql    sql语句
     *
     * @return array        返回查询的数据
     * @throws Exception    异常
     */
    public function query($sql)
    {
//        echo 1;die;
        try {
            $res = self::$pdo->query($sql);
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 执行无结果集的操作(update、delete、insert)
     * @param $sql sql 语句
     * @return int 返回受影响条数
     * @throws Exception 异常
     */
    public function exec($sql)
    {
        try {
            return self::$pdo->exec($sql);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}