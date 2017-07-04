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

class LevelController extends AdminController
{
    protected $modelName='levels';
    protected $model;
    protected $title = '关卡管理';
    protected $editName;
    
    public function _initialize(){
        parent::_initialize();
        $this->model = D($this->modelName);
        $this->editName = 'edit'; //新增编辑的方法名
    }
    public function indexStar($page=1,$r=30){
        $modelName = 'questions';
        $model = M($modelName);
        $builder=new AdminListBuilder();
        $map['level_id']=0;
        $map['status']=['egt',0];
        if(I('title'))$map['question']=['like','%'.I('title').'%'];
        list($list,$totalCount)=$this->listPage($model,$map,$page,null,true,$r);
        $builder->title('无尽挑战题库')->suggest('从所有题库中随机挑选题目，和关卡无关')
            ->data($list)
            ->buttonNew(U('editQuestion'))
            ->search('搜索','title')
            ->keyId()
            ->keyText('question','题目')
            ->keyText('created_at','创建时间')
            ->keyText('time_limit','时间限制')
            ->keyStatus()
            ->keyDoActionEdit('editQuestion?id=###')
            ->keyDoActionEdit('deleteQuestion?id=###','删除')
            ->pagination($totalCount,$r)
            ->display();
    }
    
    public function indexGold($page=1,$r=30){
        $builder=new AdminListBuilder();
        $map['level_type']=2;
        $map['status']=1;
        list($list,$totalCount)=$this->listPage($this->model,$map,$page,null,true,$r);
        foreach ($list as &$v) {
            $v['num']=$this->model->where($map + ['id'=>['elt',$v['id']]])->count();
            $v['question_number']=M('questions')->where(['level_id'=>$v['id']])->count()?:0;
        }
        $builder->title('特殊挑战'.$this->title)
            ->data($list)
            ->keyId('id','关卡ID')
            ->keyText('num','关卡序号')
            ->keyText('question_number','题目数量')
            //->keyText('need_strength','所需体力')
            ->keyText('time_limit','时间限制')
            ->keyText('reward','星级奖励')
            //->keyText('created_at','创建时间')
            ->keyDoActionEdit($this->editName.'Gold?id=###')
            ->keyDoActionEdit('question?id=###','题目管理')
            //->keyDoActionEdit('delete?id=###','删除')
            ->pagination($totalCount,$r)
            ->display();
    }
    
    public function editStar($id=''){
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
                //->keyInteger('need_strength','所需体力')
                ->keyInteger('time_limit','时间限制')
                //->keyEditor('notice','开卷有益提示')
                ->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    
    public function editGold($id=''){
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
            //$config= "'source','|','bold','italic','underline','fontsize','forecolor','justifyleft','fontfamily'";
            $builder->title($this->title)
                ->data($data)
                ->keyId()
                //->keyInteger('need_strength','所需体力')
                ->keyInteger('time_limit','时间限制')
                ->keyInteger('reward','星级奖励')
                //->keySingleImage('notice_img1','开卷有益提示-图片1')
                //->keySingleImage('notice_img2','开卷有益提示-图片2')
                ->keyEditor('notice','开卷有益提示','APP背景为黑色，请使用白色字体')
                ->keyStatus()->keyDefault('status',1)
                ->buttonSubmit()->buttonBack()
                ->display();
        }
    }
    
    public function question($id,$page=1,$r=30)
    {
        $modelName = 'questions';
        $model = M($modelName);
        $builder=new AdminListBuilder();
        $map['level_id']=$id;
        $map['status']=['egt',0];
        list($list,$totalCount)=$this->listPage($model,$map,$page,null,true,$r);
        $builder->title($this->title)
            ->data($list)
            ->buttonNew(U('editQuestion'))
            ->keyId()
            ->keyText('question','题目')
            ->keyStatus()
            ->keyDoActionEdit('editQuestion?id=###')
            ->keyDoActionEdit('deleteQuestion?id=###','删除')
            ->pagination($totalCount,$r)
            ->display();
    }
    
    public function questionAudit($page=1,$r=30)
    {
        $modelName = 'questions';
        $model = M($modelName);
        $builder=new AdminListBuilder();
        $map['status']=0;
        list($list,$totalCount)=$this->listPage($model,$map,$page,null,true,$r);
        $builder->title('待审核题库')
            ->data($list)
            ->buttonNew(U('editQuestion'))
            ->keyId()
            ->keyText('question','题目')
            ->keyText('created_at','创建时间')
            ->keyText('time_limit','时间限制')
            ->keyDoActionEdit('editQuestion?id=###')
            ->keyDoActionEdit('deleteQuestion?id=###','删除')
            ->pagination($totalCount,$r)
            ->display();
    }
    
    public function editQuestion($id=''){
        $modelName = 'questions';
        $model = M($modelName);
        if (IS_POST) {
            $data=$model->create();
            $id = $data['id']=I('id');
            if($data){
                $data['answer_options']=json_encode(explode('|',$data['answer_options']));
                $re = $id?$model->save($data):$model->add($data);
                $this->handle($re);
            }
        } else {
            if($id){
                $data=$model->find($id);
                $data['answer_options']=implode('|',json_decode($data['answer_options'],true));
            }
            $builder = new AdminConfigBuilder();
            $builder->title($this->title)
                ->data($data)
                ->keyId()
                ->keyText('question','题目')
                ->keyTextArea('content','内容')
                ->keySingleImage('image1','图片1')
                ->keySingleImage('image2','图片2')
                ->keyTextArea('answer_options','选项','以竖线分隔选项')
                ->keySelect('right_answer','正确答案','',[0=>'第一个选项',1=>'第二个选项',2=>'第三个选项',3=>'第四个选项']);
            if($data['level_id'] == 0)$builder->keyInteger('time_limit','时间限制');
            $builder->keyStatus()->keyDefault('status',1)
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
    
    public function deleteQuestion($id=''){
        $modelName = 'questions';
        $model = M($modelName);
        $re = $model->delete($id);
        $this->handle($re,'删除');
    }
    
}