<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('email', EmailType::class)
				->add('password', RepeatedType::class, [
					'type' => PasswordType::class,
					'invalid_message' => 'Hasła muszą być takie same.',
					'options' => ['attr' => ['class' => 'password-field']],
					'required' => true,
					'first_options' => ['label' => 'Hasło'],
					'second_options' => ['label' => 'Powtórzone hasło'],
				])
				->add('Zarejestruj', SubmitType::class)
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => User::class,
		]);
	}

}
