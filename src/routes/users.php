<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\User;

$model = new User();

$app->get('/api/v1/users', function (Request $request, Response $response, array $args) use ($model) {
	$users = $model->all();
	return $response->withJson($users);
});

$app->post('/api/v1/users', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$chamado = $model->create($data);
	$users_count = $model->count();
	return $response->withJson($chamado);
});

$app->get('/api/v1/users/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$chamado = $model->findOrFail($args['id']);
	$users_count = $model->count();
	return $response->withJson($chamado);
});

$app->put('/api/v1/users/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$chamado = $model->findOrFail($args['id']);
	$chamado->update($data);
	$users_count = $model->count();
	return $response->withJson($chamado);
});

$app->delete('/api/v1/users/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$chamado = $model->findOrFail($args['id']);
	$chamado->delete();
	$users_count = $model->count();
	return $response->withJson($chamado);
});