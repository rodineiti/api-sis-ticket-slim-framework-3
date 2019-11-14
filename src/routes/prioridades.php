<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Prioridade;

$model = new Prioridade();

// ROTAS ADMIN
$app->get('/api/v1/prioridades', function (Request $request, Response $response, array $args) use ($model) {
	$prioridades = $model->all();
	return $response->withJson($prioridades);
});

$app->post('/api/v1/prioridades', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$prioridade = $model->create($data);
	return $response->withJson($prioridade);
});

$app->get('/api/v1/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$prioridade = $model->findOrFail($args['id']);
	return $response->withJson($prioridade);
});

$app->put('/api/v1/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$prioridade = $model->findOrFail($args['id']);
	$prioridade->update($data);
	return $response->withJson($prioridade);
});

$app->delete('/api/v1/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$prioridade = $model->findOrFail($args['id']);
	$prioridade->delete();
	return $response->withJson($prioridade);
});

// ROTAS CLIENTE
$app->get('/api/v2/{clientToken}/prioridades', function (Request $request, Response $response, array $args) use ($model) {
	$prioridades = $model->all();
	return $response->withJson($prioridades);
});

$app->post('/api/v2/{clientToken}/prioridades', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$prioridade = $model->create($data);
	return $response->withJson($prioridade);
});

$app->get('/api/v2/{clientToken}/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$prioridade = $model->findOrFail($args['id']);
	return $response->withJson($prioridade);
});

$app->put('/api/v2/{clientToken}/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$prioridade = $model->findOrFail($args['id']);
	$prioridade->update($data);
	return $response->withJson($prioridade);
});

$app->delete('/api/v2/{clientToken}/prioridades/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$prioridade = $model->findOrFail($args['id']);
	$prioridade->delete();
	return $response->withJson($prioridade);
});