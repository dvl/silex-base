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

// Sessions

$app->register(new Silex\Provider\SessionServiceProvider());

// Url Generator

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Validator

$app->register(new Silex\Provider\ValidatorServiceProvider());

// Forms

$app->register(new Silex\Provider\FormServiceProvider());

// Translations (Needed for forms)

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	'locale_fallback' => 'en',
));

// Auth

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
	'security.firewalls' => array(
		'login' => array(
			'pattern' => '^/login$',
			'anonymous' => true
		),
		'site' => array(
			'pattern' => '^/.*$',
			'anonymous' => false,
		),
	),
));

# http://www.bubblecode.net/en/2012/08/28/mysql-authentication-in-silex-the-php-micro-framework/
# https://github.com/manelpm10/Silex-MVC-Example-with-Auth/blob/master/src/app.php