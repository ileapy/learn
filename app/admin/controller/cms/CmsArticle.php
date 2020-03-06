<?php


namespace app\admin\controller\cms;


use app\admin\controller\AuthController;
use app\admin\model\cms\CmsCategory as CModel;
use app\admin\model\cms\CmsArticle as AModel;
use app\Request;
use learn\services\JsonService as Json;
use learn\services\UtilService as Util;

class CmsArticle extends AuthController
{
    /**
     * 文章
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index(Request $request)
    {
        $where = Util::postMore([
            ['name',""],
            ['page',1]
        ]);
        $this->assign("list",AModel::systemPage($where));
        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add(Request $request)
    {
        $this->assign("category",CModel::selectByType(1));
        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit(Request $request)
    {
        $this->assign("category",CModel::selectByType(1));
        $this->assign("info",PModel::get($request->param(['cid'])));
        return $this->fetch();
    }

    /**
     * 保存
     * @param int $id
     * @return void
     */
    public function save($id=0)
    {
        $data = Util::postMore([
            ['cid',0],
            ['content',''],
            ['show_time',''],
            ['status',1],
        ]);
        if ($data['show_time']) $data['show_time'] = strtotime($data['show_time']);
        if ($data['content']) $data['content'] = htmlentities($data['content']);
        if ($id==0)
        {
            $data['create_user'] = $this->adminId;
            $data['create_time'] = time();
            $res = PModel::insert($data);
        }else
        {
            $data['update_user'] = $this->adminId;
            $data['update_time'] = time();
            $res = PModel::update($data,['cid'=>$id]);
        }
        return $res ? Json::success("操作成功") : app("json")->fail("操作失败");
    }
}