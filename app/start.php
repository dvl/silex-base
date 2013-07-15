<?php

// Config

require_once __DIR__ . '/config.php';

if (array_key_exists($_SERVER['SERVER_NAME'], $environments)) {
	require_once __DIR__ . '/../app/config/' . $environments[$_SERVER['SERVER_NAME']] . '.php';
}

// Rotas

require_once __DIR__ . '/routes.php';

// Doctrine

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => $dbs
));