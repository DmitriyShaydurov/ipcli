<?php
namespace App\Services\Outputs;

abstract class Output
{
    public $error;
    abstract public function isDone($data);
}
