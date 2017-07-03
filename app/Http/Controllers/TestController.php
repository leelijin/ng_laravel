<?php
/**
 * Created by PhpStorm.
 * User: 59431
 * Date: 2017/1/1
 * Time: 11:39
 */

namespace App\Http\Controllers;



use App\Services\QuestionListImport;
use Maatwebsite\Excel\Facades\Excel;

class TestController
{
    public function index(QuestionListImport $import)
    {
        return $import->getRawData();
        
    }
    //public function index()
    //{
    //    $file_path=resource_path().'/excel/ng_demo.xlsx';
    //    Excel::load($file_path,function($reader){
    //        dd($reader->getSheet(0)->toArray());
    //    });
    //}
    
}