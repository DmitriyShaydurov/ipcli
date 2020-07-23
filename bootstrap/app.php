<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

require __DIR__.'/../vendor/autoload.php';


use ipcli\App;
use ipcli\CliInformer;
use ipcli\CommandRegistry;
use App\Services\Outputs\CsvOutput;

$informer = new CliInformer();
$registry = new CommandRegistry();


$app = new App($informer, $registry);

// bind your services here
$app->bindService('csv', function () {
    return new CsvOutput(dirname(dirname(__FILE__)) . '\public\\example.csv');
});

return $app;
