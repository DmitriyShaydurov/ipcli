<?php

namespace App\Controllers;

use ipcli\Controller;

class ConvertController extends Controller
{
    protected $letters;

    /**
     * Display usage hint or responce
     * @param array $argv
     * @return string
     */
    public function index($argv)
    {
        if (isset($argv[2])) {
            $responce = $this->response($argv);
            $this->getApp()->getPrinter()->display($responce);
            return $responce;
        } else {
            $usageHint = "usage: convert [string]";
            $this->getApp()->getPrinter()->display($usageHint);
            return $usageHint;
        }
    }

    /**
     * Prepare usage hint or responce
     * @param array $argv
     * @return string|bool
     */
    protected function response($argv)
    {
        $line = $this->getParameterLine($argv);
        $this->makeArray($line);
        $secondOutput = $this->secondOutput();
    
        return ($secondOutput) ? $this->convertLine($line) : $secondOutput;
    }

    /**
     * Write to the second output and return an error if not succeed
     * @return string|bool
     */
    protected function secondOutput()
    {
        $secondOutput = $this->getApp()->getService('csv');
        return($secondOutput->isDone($this->letters)) ? true : $secondOutput->error;
    }

    /**
     * Make single line from arguments array
     * @param array $argv
     * @return string
     */
    protected function getParameterLine($argv)
    {
        $line ='';
        for ($i = 2; $i < count($argv); $i++) {
            $line .= $argv[$i] . ' ';
        }
        return trim($line);
    }

    /**
     * Make final line
     * @param string $line
     * @return string
     */
    protected function convertLine($line)
    {
        return strtoupper($line) . $this->alternateLine($line) . "\n" . 'CSV created!';
    }

    /** Make array from the string
     * @param string $line
     * @return void
     */
    protected function makeArray($line)
    {
        $this->letters = str_split($line);
    }

    /** Make string with alternate chars
     * @param string $line
     * @return string
     */
    protected function alternateLine()
    {
        $resultString = "\n";
        for ($i=0; $i < count($this->letters); $i++) {
            $resultString .= ($i % 2) ?  strtoupper($this->letters[$i]) : strtolower($this->letters[$i]);
        }
        return $resultString;
    }
}
