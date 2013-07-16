<?php

namespace Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginForm extends AbstractType
{
	public function getName() 
	{
		return 'login';
	}

	public function buildForm(FormBuilderInterface $builder, Array $options)
	{
		$builder->add('nomelogin');
		$builder->add('senha', 'password');
		$builder->add('logar', 'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'required' => false,

		));
	}
}