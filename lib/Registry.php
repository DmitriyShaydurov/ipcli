<?php

namespace ipcli;

abstract class Registry
{
    protected $registry = [];

    protected $controllers = [];

    abstract public function registerController($command_name, Controller $controller);

    abstract public function registerCommand($name, $callable);

    abstract public function getController($command);

    abstract public function getCommand($command);

    abstract public function getCallable($command_name);
}
