<?php
namespace ipcli;

class App
{
    protected $printer;

    protected $command_registry;

    protected $service_bindins = [];

    public function __construct(InformerInreface $informer, Registry $commandRegistry)
    {
        $this->printer = $informer;
        $this->command_registry = $commandRegistry;
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function registerController($name, Controller $controller)
    {
        $this->command_registry->registerController($name, $controller);
    }

    public function registerCommand($name, $callable)
    {
        $this->command_registry->registerCommand($name, $callable);
    }

    public function bindService($key, $helper)
    {
        $this->helper_bindins[$key] = $helper;
    }

    public function getService($key)
    {
        return isset($this->helper_bindins[$key]) ? call_user_func($this->helper_bindins[$key]) : null;
    }

    public function runCommand(array $argv = [], $defaultCommand = 'help')
    {
        $command_name = $defaultCommand;

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        try {
            call_user_func($this->command_registry->getCallable($command_name), $argv);
        } catch (\Exception $e) {
            $this->getPrinter()->display("ERROR: " . $e->getMessage());
            exit;
        }
    }
}
