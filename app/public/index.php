<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$loader = new Loader();

$loader->registerDirs(
    [
        '/var/www/app/controllers/',
        //    __DIR__ . '/../app/controllers/',
    ]
)->register();

$di = new FactoryDefault();

// ビューコンポーネントの設定
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(__DIR__ . '/../app/views/');
        return $view;
    }
);

$application = new Application($di);

try {
    $response = $application->handle($_SERVER["REQUEST_URI"]);

    
    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
