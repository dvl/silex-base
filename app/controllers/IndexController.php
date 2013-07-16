<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;

class IndexController implements ControllerProviderInterface
{
	public function connect(Application $app) 
	{
		$controller = $app['controllers_factory'];

		$controller->get('/', array($this, 'index'));
		$controller->get('/login', array($this, 'login'));
		$controller->post('/login', array($this, 'dologin'))->bind('login');

		return $controller;
	}

	public function index(Application $app)
	{
		if (!$auth)
			return $app->redirect('/login');

		return $app['twig']->render('home/index.twig', array());
	}

	public function login(Application $app)
	{
		$form = $app['form.factory']->create(new \Forms\LoginForm());

		return $app['twig']->render('home/login.twig', array('form' => $form->createView()));
	}

	public function dologin(Application $app)
	{
		
	}
}