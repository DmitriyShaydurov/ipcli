<?php

namespace App\Services\Outputs;

use PHPUnit\Framework\TestCase;
use ipcli\App;
use ipcli\CliInformer;
use ipcli\CommandRegistry;
use App\Services\Outputs\CsvOutput;
use App\Controllers\ConvertController;

class ConvertControllerTest extends TestCase
{
    protected $convertController;

    protected function setUp(): void
    {
        parent::setUp();
        $informer = new CliInformer();
        $registry = new CommandRegistry();
        $app = new App($informer, $registry);
        $app->bindService('csv', function () {
            return new CsvOutput($_SERVER["DOCUMENT_ROOT"] . 'public/example.php');
        });
        $this->convertController =  new ConvertController($app);
    }
    
    public function testIndex()
    {
        $this->assertEquals('usage: convert [string]', $this->convertController->index([]));
        echo  $this->convertController->index(['convert', 'hello']);
        $this->assertEquals("HELLO\nhElLo\nCSV created!", $this->convertController->index(['ipcli', 'convert', 'hello']));
    }
}
