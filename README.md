# Slim 3 Very simple REST Skeleton

This is a simple skeleton project for Slim 3 that implements a simple REST API.
Based on [https://github.com/moritz-h/slim3-rest-skeleton] who is based on [akrabat's slim3-skeleton](https://github.com/akrabat/slim3-skeleton)

## Purpose

Many micro web frameworks are not that micro, 19 Mb is not a micro framework. Slim provides a low footprint and fast web framework in about 1,5 Mb.

Although Slim gives you the flexibility to organize as you like. I saw a need to organize some basic structures and code for a RestFul API.

**Words of Caution**: this techniques are just my experience and nothing of it has been sanctioned or approved by anyone. Use at your own discretion. 

Take your time to understand how Slim works. http://www.slimframework.com/docs

## Main specs

- Specially oriented to develop Restful APIs using JSON
- Reusable generic Controller and Database access with common CRUD operations
- No need to define models, database columns for simple database access
- Supports ordering the resource list /books?order=price
- Table name given by the resource name / user defined
- Best practices in HTTP return codes
- API Rate limiter middleware, for throttling excesive requests

## Install

To explain

## Steps for any new table

**1 Create Database**

```sql
CREATE TABLE IF NOT EXISTS `books` (
`id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


ALTER TABLE `books`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
```

**2 Add the routes (routes.php)**, add the controller to the resources. Where _Controller is the generic CRUD controller

```php
// Books controller
$app->group('/books', function () {
    $this->get   ('',             _Controller::class.':getAll');
    $this->get   ('/{id:[0-9]+}', _Controller::class.':get');
    $this->post  ('',             _Controller::class.':add');
    $this->put   ('/{id:[0-9]+}', _Controller::class.':update');
    $this->delete('/{id:[0-9]+}', _Controller::class.':delete');
});
```

**3 Prepare the Dependencies (dependencies.php)**

If you just want to use the basic CRUD. Nothing to do here! 

If you want to change Controller / DatabaseAccess add this:

At the beginning:

```php
use App\Controllers\MyCustomController;
use App\DataAccess\MyCustomDataAccess;
```

at the end:

```php
// Custom Controllers / DataAccess
$container['App\Controllers\MyCustomController'] = function ($c) {
    return new MyCustomController($c->get('logger'), '', $c->get('App\DataAccess\MyCustomDataAccess'));
};

$container['App\DataAccess\MyCustomDataAccess'] = function ($c) {
    return new MyCustomDataAccess($c->get('logger'), $c->get('pdo'), '');
};
```

## Database table for resource

The database table can be defined in some ways

- automatically by matching with the resource name (using generic _DataAccess as is)
- by the middleware, assigning settings => localtable. Modify **routes.php** and add a group middleware for the resource:

```php
// Books controller
$app->group('/books', function () {
    $this->get   ('',             _Controller::class.':getAll');
    $this->get   ('/{id:[0-9]+}', _Controller::class.':get');
    $this->post  ('',             _Controller::class.':add');
    $this->put   ('/{id:[0-9]+}', _Controller::class.':update');
    $this->delete('/{id:[0-9]+}', _Controller::class.':delete');
})->add(function ($request, $response, $next) {
    $this->settings['localtable'] = “OtherTable”;
    $response = $next($request, $response);
    return $response;
});
```
- create your own DataAccess class in **dependencies.php**. The third parameter is the table name (if empty takes resource name as the table):

```php
$container['App\DataAccess\MyCustomDataAccess'] = function ($c) {
    return new MyCustomDataAccess($c->get('logger'), $c->get('pdo'), ‘OtherTable’);
};
```

## API Rate Limiter

Taken from https://github.com/pabloroca/slim3-apiratelimit-middleware but with a better integration



