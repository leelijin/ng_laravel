<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/1/23
 * Time: 9:36
 */

namespace Admin\Controller;


use Admin\Builder\AdminListBuilder;

class UsersController extends AdminController
{
    protected $modelName='users';
    protected $model;
    protected $title = '用户管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function index($page=1,$r=30){
        $builder=new AdminListBuilder();
        $postData = I();
        if($postData['key'])$map['mobile']=['like','%'.trim($postData['key']).'%']; //搜索关键词
        $map['status']=1;
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        $builder->title($this->title)
            //->buttonNew(U($this->editName))
            ->search('按手机搜索：')
            //->buttonDelete(U('setStatus?model='.$this->modelName))
            //->setSelectPostUrl(U())
            //->select('','type','select','','','',[['id'=>1,'value'=>''],['id'=>2,'value'=>'']])
            ->data($list)
            ->keyId()
            ->keyText('nickname','用户昵称')
            ->keyText('mobile','用户手机')
            ->keyText('rank','等级')
            //->keyText('gold','金币')
            //->keyText('star','星级')
            ->keyText('current_star_level','当前星级场关卡')
            ->keyText('current_gold_level','当前金币场关卡')
            ->keyText('created_at','注册时间')
            //->keyDoActionEdit($this->editName.'?id=###')
            ->pagination($totalCount,$r)
            ->display();
    }
}