<?php

namespace app\admin\controller;

use learn\basic\admin\BaseController;
use think\App;

/**
 * 控制器基础类
 */
abstract class AuthController extends BaseController
{
    /**
     * 当前登陆管理员信息
     * @var
     */
    protected $adminInfo;

    /**
     * 当前登陆管理员ID
     * @var int
     */
    protected $adminId;

    /**
     * 当前管理员权限
     * @var array
     */
    protected $auth = [];

    /**
     * 无需登录的方法,同时也就不需要鉴权了
     * @var array
     */
    protected $noNeedLogin = [];

    /**
     * 无需鉴权的方法,但需要登录
     * @var array
     */
    protected $noNeedRight = [];

    /**
     * 当前模块
     * @var string
     */
    private $module = "";

    /**
     * 当前控制器
     * @var string
     */
    private $controller = "";

    protected function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->module = $this->request->action();
        var_dump($this->module);
    }

    public function checkAuth()
    {

    }
}