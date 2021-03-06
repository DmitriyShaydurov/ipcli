<?php

namespace ipcli;

class CommandRegistry extends Registry
{
    protected $registry = [];

    protected $controllers = [];

    public function registerController($command_name, Controller $controller)
    {
        $this->controllers[$command_name] = $controller ;
    }

    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    public function getController($command)
    {
        return isset($this->controllers[$command]) ? $this->controllers[$command] : null;
    }

    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    public function getCallable($command_name)
    {
        $controller = $this->getController($command_name);

        if ($controller instanceof Controller) {
            return [ $controller, 'index' ];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            throw new \Exception("Command \"$command_name\" not found.");
        }

        return $command;
    }
}
