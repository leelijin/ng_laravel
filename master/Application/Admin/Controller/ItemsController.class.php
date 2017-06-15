<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/1/23
 * Time: 9:36
 */

namespace Admin\Controller;


use Admin\Builder\AdminConfigBuilder;
use Admin\Builder\AdminListBuilder;

class ItemsController extends AdminController
{
    protected $modelName='items';
    protected $model;
    protected $title = '道具管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function index($page=1,$r=30){
        $builder=new AdminListBuilder();
        //$postData = I();
        //if($postData['key'])$map['mobile']=['like','%'.trim($postData['key']).'%']; //搜索关键词
        //$map['status']=1;
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        $builder->title($this->title)
            //->buttonNew(U($this->editName))
            //->search('按手机搜索：')
            //->buttonDelete(U('setStatus?model='.$this->modelName))
            //->setSelectPostUrl(U())
            //->select('','type','select','','','',[['id'=>1,'value'=>''],['id'=>2,'value'=>'']])
            ->data($list)
            ->keyId()
            ->keyImage('cover','封面')
            ->keyText('title','道具名称')
            ->keyText('desc','道具描述')
            ->keyStatus()
            ->keyDoActionEdit($this->editName.'?id=###','配置')
            ->pagination($totalCount,$r)
            ->display();
    }
    
    public function edit($id=''){
        if (IS_POST) {
            $data=$this->model->create();
            $id = $data['id']=I('id');
            if($data){
                $re = $id?$this->model->save($data):$this->model->add($data);
                $this->handle($re);
            }
        } else {
            if($id)$data=$this->model->find($id);
            $builder = new AdminConfigBuilder();
            $builder->title($this->title)
                ->data($data)
                ->keyId()
                ->keySingleImage('cover','封面')
                ->keyText('title','道具名称')
                ->keyText('desc','道具描述')
                ->keyInteger('need_gold','需要金币')
                ->keyTextArea('setting','配置选项')
                ->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
}