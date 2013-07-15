<?php

define('APP_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__ . '/../paths.php';
require_once __DIR__ . '/../app/start.php';

if ($app['debug']) {
	$app->run();
}
else {
	$app['http_cache']->run();
}