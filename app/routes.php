<?php

// $app->mount('/', new \Controller\IndexController());

$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM sdk_usuario WHERE nomelogin = ?";
    $post = $app['db']->fetchAssoc($sql, array('ANDRE.LUIZ'));

    return print_r($post);
});