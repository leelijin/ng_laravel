<?php

namespace App\Http\Controllers;

use App\Jobs\ImportExcelJob;
use App\Models\File;

class FileController extends Controller
{
    public function import(File $file)
    {
        $this->dispatch(new ImportExcelJob($file));
        //return config('app.master_url').$file->savepath.$file->savename;
    }
}
