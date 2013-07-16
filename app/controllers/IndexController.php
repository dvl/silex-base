<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

class IndexController implements ControllerProviderInterface
{
	public function connect(Application $app) 
	{
		$controller = $app['controllers_factory'];

		$controller->get('/', array($this, 'index'));
		$controller->get('/login', array($this, 'login'));
		// $controller->post('/login', array($this, 'dologin'))->bind('login');

		return $controller;
	}

	public function index(Application $app)
	{
		$token = $app['security']->getToken();

		if ($token === null)
			return $app->redirect('/login');

		return $app['twig']->render('home/index.twig', array());
	}

	public function login(Application $app, Request $request)
	{
		$form = $app['form.factory']->create(new \Forms\LoginForm());

		return $app['twig']->render('home/login.twig', array(
			'form' => $form->createView(),
			'error' => $app['security.last_error']($request)
		));
	}

	public function dologin(Application $app, Request $request)
	{
		$form = $app['form.factory']->create(new \Forms\LoginForm());

		$form->handleRequest($request);

		$formdata = $request->get('login');

		if ($form->isValid())
			return print_r($formdata);

		else
			return 'erro';
	}
}