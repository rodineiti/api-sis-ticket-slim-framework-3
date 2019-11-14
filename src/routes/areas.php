<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Area;

$model = new Area();

// ROTAS ADMIN
$app->get('/api/v1/areas', function (Request $request, Response $response, array $args) use ($model) {
	$areas = $model->all();
	return $response->withJson($areas);
});

$app->post('/api/v1/areas', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$area = $model->create($data);
	return $response->withJson($area);
});

$app->get('/api/v1/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$area = $model->findOrFail($args['id']);
	return $response->withJson($area);
});

$app->put('/api/v1/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$area = $model->findOrFail($args['id']);
	$area->update($data);
	return $response->withJson($area);
});

$app->delete('/api/v1/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$area = $model->findOrFail($args['id']);
	$area->delete();
	return $response->withJson($area);
});

// ROTAS CLIENTE
$app->get('/api/v2/{clientToken}/areas', function (Request $request, Response $response, array $args) use ($model) {
	$areas = $model->all();
	return $response->withJson($areas);
});

$app->post('/api/v2/{clientToken}/areas', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$area = $model->create($data);
	return $response->withJson($area);
});

$app->get('/api/v2/{clientToken}/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$area = $model->findOrFail($args['id']);
	return $response->withJson($area);
});

$app->put('/api/v2/{clientToken}/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$area = $model->findOrFail($args['id']);
	$area->update($data);
	return $response->withJson($area);
});

$app->delete('/api/v2/{clientToken}/areas/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$area = $model->findOrFail($args['id']);
	$area->delete();
	return $response->withJson($area);
});