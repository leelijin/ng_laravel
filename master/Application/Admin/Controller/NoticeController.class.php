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

class NoticeController extends AdminController
{
    protected $modelName='notice';
    protected $model;
    protected $title = '公告管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function index($page=1,$r=30){
        $builder=new AdminListBuilder();
        //$postData = I();
        //if($postData['key'])$map['title']=['like','%'.trim($postData['key']).'%']; //搜索关键词
        $map['status']=1;
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        $builder->title($this->title)
            ->buttonNew(U($this->editName))
            //->search('按标题搜索：')
            //->buttonDelete(U('setStatus?model='.$this->modelName))
            //->setSelectPostUrl(U())
            //->select('','type','select','','','',[['id'=>1,'value'=>''],['id'=>2,'value'=>'']])
            ->data($list)
            ->keyText('title','标题')
            ->keyText('content','内容')
            ->keyText('link','链接')
            ->keyText('created_at','创建时间')
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
                ->keyText('title','标题')
                ->keyTextArea('content','内容')
                ->keyText('link','链接')
                //->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    
    public function delete($id=''){
        $re = $this->model->delete($id);
        $this->handle($re,'删除');
    }
    
    public function pageEdit()
    {
        $config_name = 'CONTACT_US_WEB';
        $model = M('config');
        if (IS_POST) {
            $data=I();
            $data['value']=json_encode([$data['img'],$data['content']]);
            $this->handle($model->save($data));
        } else {
            $data=$model->where(['name'=>$config_name])->find();
            $value=json_decode($data['value']);
            $data['img']=$value['img'];$data['content']=$value['content'];
            $builder = new AdminConfigBuilder();
            $builder->title('联系我们网页')
                ->data($data)
                ->keyId()
                ->keySingleImage('img','图片')
                ->keyEditor('content','内容')
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    
}