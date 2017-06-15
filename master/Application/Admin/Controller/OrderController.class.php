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

class OrderController extends AdminController
{
    protected $modelName='orders';
    protected $model;
    protected $title = '支付管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function index($page=1,$r=30){
        $builder=new AdminListBuilder();
        $map=[];
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        $builder->title($this->title)
            ->data($list)
            ->keyText('order_id','商户订单号')
            ->keyText('transaction_id','三方订单号')
            ->keyText('order_name','订单名称')
            ->keyText('order_price','订单价格')
            ->key('status','支付状态','status',[0=>'待支付',1=>'已支付'])
            //->keyDoActionEdit($this->editName.'?id=###')
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
                ->keyText('','')
                ->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    
}