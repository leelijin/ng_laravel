<?php

namespace App\Jobs;

use App\Models\File;
use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    
    /**
     * Create a new job instance.
     *
     * @param \App\Models\File $file
     */
    public function __construct(File $file)
    {
        $this->file=$file;
    }
    
    /**
     * Execute the job.
     *
     * @param \App\Services\QuestionListImport $qli
     *
     * @return void
     */
    public function handle()
    {
        $excelPath = 'master/'.$this->file->savepath.$this->file->savename;
       
        $excelList =  Excel::load($excelPath)->getSheet(0)->toArray();
        $rawList = collect($excelList)->map(function($item){
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
