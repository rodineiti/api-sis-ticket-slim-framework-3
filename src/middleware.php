<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// controle de autenticação por usuario autenticado no sistema com JWT
/*$app->add(new \Tuupola\Middleware\JwtAuthentication([
    'regexp' => '/(.*)/',
    'header' => 'Authorization',
    'path' => '/api',
    'realm' => 'Protected',
    'secret' => $container['settings']['secretKey']
]));*/

// controle de autenticação por QueryString, token na própria URL
$app->add(function ($req, $res, $next) {
    $token = filter_input(INPUT_GET, 'token');    
    if (!$token) {
    	return $res->withJson(['status' => 'error', 'message' => 'Token não informado'], 401);
    }
    $secretToken = $this->get('settings')['secretToken'];
    if ($token != $secretToken) {
    	return $res->withJson(['status' => 'error', 'message' => 'Token inválido'], 401);
    }
    $req = $req->withHeader('Authorization', $token);
    return $next($req, $res);
});

$app->add(function($req, $res, $next) {
	$response = $next($req, $res);
	return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Authorization, Origin, Accept')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});