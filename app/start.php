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

$app->register(new Silex\Provider\SessionServiceProvider(), array(
	'session.storage.save_path' => __DIR__ . '/../storage/sessions',
));

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
		// Rotas que não precisa estar logado
		'login' => array(
			'pattern' => '^/login$',
			'anonymous' => true
		),
		// Rotas que necessitam de autenticação
		'site' => array(
			'pattern' => '^/.*$',
			'form'	=> array(
				'login_path' => '/login',
				'username_parameter' => 'form[nomelogin]',
				'password_parameter' => 'form[senha]',
			),
			'anonymous' => false,
			'logout' => array('logout_path' => '/logout'),
			'users' => $app->share(function() use ($app) {
				return new \Providers\UserProvider($app['dbs']['apoteste']);
			}),
		),
	),
));

# http://www.bubblecode.net/en/2012/08/28/mysql-authentication-in-silex-the-php-micro-framework/
# https://github.com/manelpm10/Silex-MVC-Example-with-Auth/blob/master/src/app.php
# http://stackoverflow.com/questions/14704266/user-authentication-with-a-db-backed-userprovider-in-silex

// Assetic

$app->register(new SilexAssetic\AsseticServiceProvider(), array(
	'assetic.path_to_web' => __DIR__ . '/../public/assets/',
	'assetic.options' => array(
		'debug' => true
	),
));


$app->boot();