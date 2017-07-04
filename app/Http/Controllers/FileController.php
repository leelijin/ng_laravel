<?php

namespace App\Http\Controllers;

use App\Jobs\ImportExcelJob;
use App\Models\File;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function import($file)
    {
        $this->dispatch(new ImportExcelJob(File::find($file)));
    }
    
}
