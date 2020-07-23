<?php

namespace ipcli;

abstract class Controller
{
    protected $app;

    abstract public function index($argv);

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function getApp()
    {
        return $this->app;
    }
}
