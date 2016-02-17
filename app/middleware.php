<?php

// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(function ($request, $response, $next) {
    $responsen = $response->withHeader('Content-Type', 'application/json')
                          ->withHeader('X-Powered-By', $this->settings['PoweredBy']);
	
    $responsen = $next($request, $responsen);

    return $responsen;
});
