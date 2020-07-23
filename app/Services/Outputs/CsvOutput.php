<?php
namespace App\Services\Outputs;

class CsvOutput extends Output
{
    protected $fileName;
    public $error;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }
    
    /** Saves array to csv file
     * @param array $csvColumns
     * @return bool
     */
    public function isDone($csvColumns)
    {
        $handle =  $this->openFile($this->fileName);
        if ($handle === false) {
            echo $this->error;
            return false;
        }
        fputcsv($handle, $csvColumns);
        fclose($handle);
        return true;
    }

    protected function openFile()
    {
        $handle = fopen($this->fileName, "w");
        if ($handle === false) {
            $this->error = 'can not open file';
            return false;
        } else {
            return $handle;
        }
    }
}
