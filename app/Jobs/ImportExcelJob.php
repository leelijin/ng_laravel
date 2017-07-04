<?php

namespace App\Jobs;

use App\Models\File;
use App\Services\QuestionListImport;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;
use Mockery\Exception;

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
     * @return void
     */
    public function handle()
    {
        $excelPath = config('app.master_url').$this->file->savepath.$this->file->savename;
        $qli = new QuestionListImport();
        $qli->filePath=$excelPath;
        $qli->saveRawData();
    }
}
