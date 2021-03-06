<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
use App\Models\QuestionWrong;
use App\Models\User;
use App\Repository\LevelRepo;
use App\Repository\RankRepo;
use App\Repository\UserRepo;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    
    public function starList()
    {
        return apiError(1,'此接口已弃用');
        $limit = 20;
        
        $current_level = User::whereId($this->uid)->value('current_star_level');
        
        $star_level_list = LevelRepo::getLevelList('star',$current_level,$this->page,$limit);
        
        return apiSuccess($star_level_list);
    }
    
    public function goldList()
    {
        $page = $this->request->has('page') ? $this->params['page'] : 1;
        $limit = 20;
        
        $current_level = User::whereId($this->uid)->value('current_gold_level');
        
        $gold_level_list = LevelRepo::getLevelList('gold',$current_level,$page,$limit);
        
        foreach ($gold_level_list as &$v) {
            $v->challenge_times = 0;
        }
        
        return apiSuccess(compact('current_level','gold_level_list'));
    }
    
    public function starDetail()
    {
        $this->limit = 10;//写死10
        $conditionDown = LevelRepo::checkUserCondition($this->uid,0,1);
        if ($conditionDown) return $conditionDown;
        $model = Question::where('level_id',0)->orderByRaw('rand()')->passing($this->uid);
        if ($this->limit != 0) {
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        $star_question_list = $model->get();
        $sum = 0;
        foreach ($star_question_list as $star) {
            $sum += $star->time_limit;
        }
        $current_level = User::whereId($this->uid)->value('current_star_level');
        $total_time_limit = (int)$sum;
        return apiSuccess(compact('current_level','total_time_limit','star_question_list'));
    }
    
    public function starDetailJudge()
    {
        $conditionDown = LevelRepo::checkUserCondition($this->uid,$this->params['star_id'],1);
        if ($conditionDown) return $conditionDown;
        return apiSuccess(['message'       => '条件通过',
                           'user_strength' => UserRepo::getUserStrength($this->uid)
        ]);
    }
    
    public function goldDetail(Request $request)
    {
        $current_level = User::whereId($this->uid)->value('current_gold_level');
        $gold_id = LevelRepo::getUserCurrentGoldLevelId($current_level);
        if (!$gold_id) return apiError(1,'无更多关卡');
        $check = LevelRepo::checkUserCondition($this->uid,$gold_id,2);
        if ($check) return $check;
        $model = Question::passing($this->uid)->whereLevelId($gold_id);
        if ($this->limit != 0) {
            $model = $model->take($this->limit)->offset(($this->page - 1) * $this->limit);
        }
        
        $level_info = Level::gold()->find($gold_id);
        $notice = $level_info->getOriginal('notice');
        $level_info->num = LevelRepo::getLevelNum($gold_id,2);
        $level_info = $level_info->toArray();
        
        if($request->has('client') && $request->get('client') == 'android'){
            $level_info['notice'] = $notice;
        }
        
        
        $gold_question_list = $model->inRandomOrder()->get();
        return apiSuccess(compact('current_level','level_info','gold_question_list'));
    }
    
    public function goldDetailJudge()
    {
        $check = LevelRepo::checkUserCondition($this->uid,$this->params['gold_id'],2);
        if ($check) return $check;
        return apiSuccess(['message'       => '条件通过',
                           'user_strength' => UserRepo::getUserStrength($this->uid)
        ]);
    }
    
    public function rank()
    {
        $list = RankRepo::getRank('top',$this->limit);
        return apiSuccess($list);
    }
    
    public function rankFriends()
    {
        $list = RankRepo::getRank('top',$this->limit,true,$this->uid);
        return apiSuccess($list);
    }
    
    //public function rankGold()
    //{
    //    $list = RankRepo::getRank('TopGold',$this->limit);
    //    return apiSuccess($list);
    //}
    //
    //public function rankGoldFriends()
    //{
    //    $list = RankRepo::getRank('TopGold',$this->limit,true,$this->uid);
    //    return apiSuccess($list);
    //}
    
    public function starSubmit()
    {
        return LevelRepo::submitLevel(0,1,$this->uid,$this->request->has('wrong_ids') ? $this->params['wrong_ids'] : [],$this->request->has('pass_ids') ? $this->params['pass_ids'] : []);
    }
    
    public function goldSubmit()
    {
        return LevelRepo::submitLevel($this->params['gold_id'],2,$this->uid,$this->request->has('wrong_ids') ? $this->params['wrong_ids'] : []);
    }
    
    public function mineWrong()
    {
        //检查是否支付
        $auth = UserRepo::getUserWrongAuth($this->uid);
        if (!$auth) return apiError(1,'请先购买权限');
        $list = QuestionWrong::whereUid($this->uid)->select('question_id as id','question_id','type')->orderBy('id','desc')->paginate($this->limit);
        return apiSuccess($list);
    }
    
    public function mineWrongDelete()
    {
        //检查是否支付
        $re = QuestionWrong::whereUid($this->uid)->whereQuestionId($this->params['id'])->delete();
        return $re ? apiSuccess('删除成功') : apiError(1,'删除失败');
    }
    
    public function submitQuestion(Request $request)
    {
        $this->validate($request,[
            'question'     => 'required',
            'desc'         => 'required',
            'answer1'      => 'required',
            'answer2'      => 'required',
            'answer3'      => 'required',
            'answer4'      => 'required',
            'right_answer' => 'between:0,3',
        ],[
            'question'     => '问题题目必填',
            'desc'         => '问题描述必填',
            'answer1'      => '选项一必填',
            'answer2'      => '选项二必填',
            'answer3'      => '选项三必填',
            'answer4'      => '选项四必填',
            'right_answer' => '正确答案必填',
        ]);
        $re = Question::create([
            'question'       => $request->question,
            'content'        => $request->desc,
            'answer_options' => [
                $request->answer1,
                $request->answer2,
                $request->answer3,
                $request->answer4,
            ],
            'right_answer'   => $request->right_answer,
            'level_id'       => 0,
        ]);
        return $re ? apiSuccess('提交成功') : apiError(1,'提交失败');
    }
    
}
