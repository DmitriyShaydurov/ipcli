<?php

namespace App\Controllers;

use ipcli\Controller;

class HelpController extends Controller
{
    public function index($argv)
    {
        $this->getApp()->getPrinter()->display($this->getControllerNames());
    }

    /**
     * Check all controlers in Controllers folder and return
     * list of available commands
     * @return string
     */
    protected function getControllerNames()
    {
        $dirList = scandir(__DIR__);
        $commandList = "Available commands: \n \n";
        $needle = 'Controller.php';
        foreach ($dirList as $element) {
            $commandList .= (stripos($element, $needle)) ? str_replace($needle, '', $element) . "\n" : '';
        }
        return $commandList;
    }
}
