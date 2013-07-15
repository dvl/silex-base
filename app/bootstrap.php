<?php

// Doctrine

$app->register(new \Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => $dbs
));

// Rotas

require_once __DIR__ . '/routes.php';