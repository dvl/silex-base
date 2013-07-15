<?php

// Ambientes

$app['env'] = 'producao';

foreach ($environments as $environment => $key) {
	if ($environment == gethostname())
		$app['env'] = $key;
}

// Config

require_once __DIR__ . '/config.php';

if (file_exists($conf = __DIR__ . '/config/' . $app['env'] . '.php')) 
	require_once $conf;

// Rotas

require_once __DIR__ . '/routes.php';

// Doctrine

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => $dbs
));

// Twig

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/views',
	'twig.options' => array(
		'cache' => __DIR__ . '/../storage/twig'
	),
));