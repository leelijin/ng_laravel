<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2017/7/3
 * Time: 10:24
 */

namespace App\Services;


use Maatwebsite\Excel\Files\ExcelFile;

class QuestionListImport extends ExcelFile
{
    public $filePath;
    
    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        return $this->filePath;
    }
    

    
    
    
    
    
}