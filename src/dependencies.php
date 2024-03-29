<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['db'] = function($c) {
	$manager = new \Illuminate\Database\Capsule\Manager;
	$manager->addConnection($c->get('settings')['db_dev']);
	$manager->setAsGlobal();
	$manager->bootEloquent();
	return $manager->getConnection('default');
};

$container['pusher'] = function() {
    $options = array(
        'cluster' => 'us2',
        'encrypted' => false
    );
    return new Pusher\Pusher(
        '00000000000000000000',
        '00000000000000000000',
        '000000',
        $options
    );
};
