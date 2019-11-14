<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Models\Tipo;

$model = new Tipo();

// ROTAS ADMIN
$app->get('/api/v1/tipos', function (Request $request, Response $response, array $args) use ($model) {
	$tipos = $model->all();
	return $response->withJson($tipos);
});

$app->post('/api/v1/tipos', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$tipo = $model->create($data);
	return $response->withJson($tipo);
});

$app->get('/api/v1/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$tipo = $model->findOrFail($args['id']);
	return $response->withJson($tipo);
});

$app->put('/api/v1/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$tipo = $model->findOrFail($args['id']);
	$tipo->update($data);
	return $response->withJson($tipo);
});

$app->delete('/api/v1/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$tipo = $model->findOrFail($args['id']);
	$tipo->delete();
	return $response->withJson($tipo);
});


// ROTAS CLIENTE
$app->get('/api/v2/{clientToken}/tipos', function (Request $request, Response $response, array $args) use ($model) {
	$tipos = $model->all();
	return $response->withJson($tipos);
});

$app->post('/api/v2/{clientToken}/tipos', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$tipo = $model->create($data);
	return $response->withJson($tipo);
});

$app->get('/api/v2/{clientToken}/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$tipo = $model->findOrFail($args['id']);
	return $response->withJson($tipo);
});

$app->put('/api/v2/{clientToken}/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$data = $request->getParsedBody();
	$tipo = $model->findOrFail($args['id']);
	$tipo->update($data);
	return $response->withJson($tipo);
});

$app->delete('/api/v2/{clientToken}/tipos/{id}', function (Request $request, Response $response, array $args) use ($model) {
	$tipo = $model->findOrFail($args['id']);
	$tipo->delete();
	return $response->withJson($tipo);
});