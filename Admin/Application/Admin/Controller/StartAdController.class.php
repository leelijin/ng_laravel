<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/1/23
 * Time: 9:36
 */

namespace Admin\Controller;

use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;

class StartAdController extends AdminController
{
    protected $modelName='start_ad';
    protected $model;
    protected $title = '广告管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function index($page=1,$r=30){
        $builder=new AdminListBuilder();
        $map=[];
        //$postData = I();
        //if($postData['key'])$map['title']=['like','%'.trim($postData['key']).'%']; //搜索关键词
        //$map['status']=1;
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        $builder->title($this->title)
            ->buttonNew(U($this->editName))
            //->search('按标题搜索：')
            //->buttonDelete(U('setStatus?model='.$this->modelName))
            //->setSelectPostUrl(U())
            //->select('','type','select','','','',[['id'=>1,'value'=>''],['id'=>2,'value'=>'']])
            ->data($list)
            ->keyImage('cover','头图')
            ->keyText('title','名称')
            ->keyText('second','显示秒数')
            ->keyText('link','跳转链接')
            ->keyDoActionEdit($this->editName.'?id=###')
            ->keyDoActionEdit('delete?id=###','删除')
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
                ->keySingleImage('cover','头图')
                ->keyText('title','名称')
                ->keyText('second','显示秒数')
                ->keyText('link','跳转链接')
                //->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    public function setStatus($model){
        parent::setStatus($model);
    }
    public function delete($id=''){
        $re = $this->model->delete($id);
        $this->handle($re,'删除');
    }
    
}