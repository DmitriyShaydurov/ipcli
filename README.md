# About iPrice cli (ipcli)
 ipcli is a simple framework for CLI applications. Currently, it has two controllers for demonstration purposes but it could be extended easily. 
## Installation
* clone this project
* run   
<code>composer install</code>
## Framework Usage
### Add Controllers
* on public/ipcli file add you controller by extending Controller class (the name to be ended with Contoller.php)  
<code>
$app->registerController('idea', new MyNewIdeaController($app));
</code>
* place your controller in App/Controllers folder
* now controller functionality could be used as simple as   
<code>ipcli idea</code>
### Add Services
* add your service in bootstrap/app.php  
<code>
$app->bindService('YourService', function () {
    return new YourService($param);
});
</code>
* then use it in your controllers  
<code> $yourService = $this->getApp()->getService('YourService');</code>

### Add Simple commands
* add command in public/ipcli file  
<code>
$app->registerCommand('hello', function (array $argv) use ($app) {
    $app->getPrinter()->display("hello world");
});
</code>
* now your command  could be used as simple as   
<code>ipcli hello</code>
## Testing
from the main directory run  
<code>./vendor/bin/phpunit</code>
## Running test application 
Test application uses "convert" tag, to run application:  
from public directory run  
<code>php ipcli convert hello world</code>  
or make the script executable with chmod:  
<code>chmod +x ipicli</code>  
and you can run   
<code>pcli convert hello world</code>  
you should  see:
<code>
HELLO  
hElLo  
CSV created!
</code>  
the csv output  in example.csv file


