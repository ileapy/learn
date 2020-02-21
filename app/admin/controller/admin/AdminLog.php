<?php


namespace app\admin\controller\admin;


use app\admin\controller\AuthController;
use app\admin\model\admin\AdminLog as lModel;
use app\Request;
use learn\services\UtilService as Util;

/**
 * 日志
 * Class AdminLog
 * @package app\admin\controller\admin
 */
class AdminLog extends AuthController
{
    protected $noNeedLogin = [];

    /**
     * 分页
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DbException
     */
    public function index(Request $request)
    {
        $where = Util::postMore([
            ['page',1]
        ]);
        $this->assign("list",lModel::systemPage($where));
        return $this->fetch();
    }
}