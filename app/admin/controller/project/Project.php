<?php


namespace app\admin\controller\project;


use app\admin\controller\AuthController;
use app\admin\model\admin\Admin as aModel;
use app\Request;
use FormBuilder\Factory\Elm;
use learn\services\FormBuilderService as Form;
use learn\services\UtilService as Util;
use learn\services\JsonService as Json;
use app\admin\model\project\project as pModel;

/**
 * 项目管理
 * Class project
 * @package app\admin\controller\project
 */
class project extends AuthController
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 列表
     * @param Request $request
     * @return mixed
     */
    public function lst(Request $request)
    {
        $where = Util::postMore([
            ['page',1],
            ['limit',20],
        ]);
        return Json::successlayui(pModel::lst($where));
    }

    /**
     * 添加
     * @param Request $request
     * @return string
     * @throws \FormBuilder\Exception\FormBuilderException
     */
    public function add(Request $request)
    {
        $form = array();
        $form[] = Elm::input('name','项目名称')->col(10);
        $form[] = Elm::select('manager','项目负责人')->options(function(){
            $list = aModel::lst();
            $menus=[];
            foreach ($list as $menu){
                $menus[] = ['value'=>$menu['id'],'label'=>$menu['id']." - ".$menu['realname']];//,'disabled'=>$menu['pid']== 0];
            }
            return $menus;
        })->col(10);
        $form[] = Elm::textarea('intro','项目简介')->col(24);
        $form[] = Elm::password('start_time','开始时间')->col(10);
        $form[] = Elm::input('end_time','结束时间')->col(10);
        $form[] = Elm::textarea('intro','项目备注')->col(24);
        $form[] = Elm::input('sql_ip','数据库IP')->col(10);
        $form[] = Elm::email('sql_name','数据库账号')->col(10);
        $form[] = Elm::input('sql_password','数据库密码')->col(10);
        $form[] = Elm::radio('status','状态',0)->options([['label'=>'未开始','value'=>0],['label'=>'进行中','value'=>1],['label'=>'已完成','value'=>2],['label'=>'维护中','value'=>3],['label'=>'以终止','value'=>4]])->col(10);
        return Form::make_post_form($form, url('save')->build());
    }
}