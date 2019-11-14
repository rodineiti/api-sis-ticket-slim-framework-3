<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Status;

$model = new Status();

// ROTAS ADMIN
$app->get('/api/v1/statuses', function (Request $request, Response $response, array $args) use ($model) {
	$statuses = $model->all();
	return $response->withJson($statuses);
});

$app->post('/api/v1/statuses', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$status = $model->create($data);
	return $response->withJson($status);
});

$app->get('/api/v1/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$status = $model->findOrFail($args['id']);
	return $response->withJson($status);
});

$app->put('/api/v1/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$status = $model->findOrFail($args['id']);
	$status->update($data);
	return $response->withJson($status);
});

$app->delete('/api/v1/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$status = $model->findOrFail($args['id']);
	$status->delete();
	return $response->withJson($status);
});

// ROTAS CLIENTE
$app->get('/api/v2/{clientToken}/statuses', function (Request $request, Response $response, array $args) use ($model) {
	$statuses = $model->all();
	return $response->withJson($statuses);
});

$app->post('/api/v2/{clientToken}/statuses', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$status = $model->create($data);
	return $response->withJson($status);
});

$app->get('/api/v2/{clientToken}/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$status = $model->findOrFail($args['id']);
	return $response->withJson($status);
});

$app->put('/api/v2/{clientToken}/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$status = $model->findOrFail($args['id']);
	$status->update($data);
	return $response->withJson($status);
});

$app->delete('/api/v2/{clientToken}/statuses/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$status = $model->findOrFail($args['id']);
	$status->delete();
	return $response->withJson($status);
});