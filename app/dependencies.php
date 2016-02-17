<?php

use App\Controllers\ApiController;

// Generic Controllers / DataAccess
use App\Controllers\_Controller;
use App\DataAccess\_DataAccess;

// Custom Controllers / DataAccess
//use App\Controllers\MyCustomController;
//use App\DataAccess\MyCustomDataAccess;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));

    return $logger;
};

// Database
$container['pdo'] = function ($c) {
    $settings = $c->get('settings')['pdo'];

    return new PDO($settings['dsn'], $settings['username'], $settings['password']);
};

// APIController
$container['App\Controllers\ApiController'] = function ($c) {
    return new ApiController($c->get('logger'),$c->get('settings')['PoweredBy']);
};

// Generic Controller
$container['App\Controllers\_Controller'] = function ($c) {
    return new _Controller($c->get('logger'), $c->get('App\DataAccess\_DataAccess'));
};

// Generic DataAccess
$container['App\DataAccess\_DataAccess'] = function ($c) {
    return new _DataAccess($c->get('logger'), $c->get('pdo'), '');
};


// Custom Controllers / DataAccess
// ...
//$container['App\Controllers\MyCustomController'] = function ($c) {
//    return new MyCustomController($c->get('logger'), '', $c->get('App\DataAccess\MyCustomDataAccess'));
//};

//$container['App\DataAccess\MyCustomDataAccess'] = function ($c) {
//    return new MyCustomDataAccess($c->get('logger'), $c->get('pdo'), '');
//};

