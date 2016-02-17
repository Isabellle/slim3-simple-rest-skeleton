<?php

use App\Controllers\ApiController;
use App\Controllers\_Controller;

// Custom Controllers
//use App\Controllers\MyCustomController;


// Routes

$app->get('/', ApiController::class.':showHello')
    ->setName('hellopage');


// Books controller
$app->group('/books', function () {
    $this->get   ('',             _Controller::class.':getAll');
    $this->get   ('/{id:[0-9]+}', _Controller::class.':get');
    $this->post  ('',             _Controller::class.':add');
    $this->put   ('/{id:[0-9]+}', _Controller::class.':update');
    $this->delete('/{id:[0-9]+}', _Controller::class.':delete');
});

// Custom Controllers
//$app->group('/mycustom', function () {
//    $this->get   ('',             MyCustomController::class.':getAll');
//    $this->post
//    ...
//});
