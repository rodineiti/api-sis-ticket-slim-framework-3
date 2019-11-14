<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$container['db'];

$app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
});

// ADMIN
require __DIR__ . '/routes/users.php';
require __DIR__ . '/routes/tipos.php';
require __DIR__ . '/routes/areas.php';
require __DIR__ . '/routes/prioridades.php';
require __DIR__ . '/routes/statuses.php';
require __DIR__ . '/routes/chamados.php';
require __DIR__ . '/routes/respostas.php';

// CLIENT
require __DIR__ . '/routes/chamados_cliente.php';
require __DIR__ . '/routes/respostas_cliente.php';