<?php
namespace tests\Controllers;

namespace App\Services\Outputs;

use PHPUnit\Framework\TestCase;

class CsvOutputTest extends TestCase
{
    protected $app;

    public function testIsDone()
    {
        $app = new CsvOutput($_SERVER["DOCUMENT_ROOT"] . 'public/example.csv');
        $this->assertTrue($app->isDone(['q', 'w', 'e', 'r', 't', 'y']));
    }
}
