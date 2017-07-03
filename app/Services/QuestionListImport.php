<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/7/3
 * Time: 10:24
 */

namespace App\Services;


use App\Models\Question;
use Maatwebsite\Excel\Files\ExcelFile;

class QuestionListImport extends ExcelFile
{
    
    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        return resource_path().'/excel/ng_demo.xlsx';
    }
    
    public function getRawData()
    {
        $rawList = collect($this->getSheet(0)->toArray())->map(function($item){
            return array_slice($item,0,11);
        });
        $rawList->shift();
        $rawList->each(function($item){
            $list=[
                'level_id'=>(int)$item[10],
                'question'=>$item[0],
                'content'=>$item[1],
                'image1'=>(int)$item[2],
                'image2'=>(int)$item[3],
                'answer_options'=>[$item[4],$item[5],$item[6],$item[7]],
                'right_answer'=>(int)($item[8]-1),
            ];
            Question::create($list);
        });
    }
    
    
    
    
    
}