<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Router;

// $content = file_get_contents('/var/www/app/controllers/UserController.php');
// echo $content;

$loader = new Loader();

$loader->registerDirs(
    [
        '/var/www/app/controllers/',
        //    __DIR__ . '/../app/controllers/',
        '/var/www/app/models/',
    ]
)->register();

$router = new Router();
$router->add(
    "/user",
    [
        "controller" => "user",
        "action"     => "index",
    ]
);
$router->add(
    "/user/create",
    [
        "controller" => "user",
        "action"     => "create",
    ]
);
$router->add(
    "/",
    [
        "controller" => "index",
        "action"     => "index",
    ]
);



$di = new FactoryDefault();

// ルーティング
$di->set('router', $router);


// 
use Phalcon\Db\Adapter\Pdo\Mysql;

$di->set('db', function() {
    return new Mysql(
        [
            'host'     => 'mysql',
            'username' => 'root',
            'password' => 'root_password',
            'dbname'   => 'phalcon_db',
        ]
    );
});

// ビューコンポーネントの設定
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(
            '/var/www/app/views/'
            // __DIR__ . '/../app/views/'
            );
        $view->registerEngines([
            ".volt" => "Phalcon\\Mvc\\View\\Engine\\Volt"
        ]);
        return $view;
    }
);

$application = new Application($di);

try {
    $response = $application->handle($_SERVER["REQUEST_URI"]);

    
    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
    echo $e->getTraceAsString();
}
