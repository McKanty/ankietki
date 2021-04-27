<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Security;

class AnkietaController extends AbstractController {

	private $security;

	public function __construct(Security $security) {
		$this->security = $security;
	}

	#[Route('/ankieta', name: 'ankieta')]

	public function index(Request $request): Response {
		$entityManager = $this->getDoctrine()->getManager();
		$user = $this->security->getUser();
		$answer = $user->getAnswers();
		if ($answer !== null) {
			return $this->render('ankieta/koniec.html.twig', [
						'wypelniono' => false,
			]);
		}


		$answer = new Answer();
		$answerForm = $this->createFormBuilder($answer)
				->add('firstname', TextType::class, ['label' => 'Imię'])
				->add('lastname', TextType::class, ['label' => 'Nazwisko'])
				->add('dalej', SubmitType::class, ['label' => 'dalej'])
				->getForm();

		$answerForm->handleRequest($request);

		if ($answerForm->isSubmitted() && $answerForm->isValid()) {
			$answer = $answerForm->getData();
			$answer->setAge(0);

			$user = $this->security->getUser();

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($answer);
			$user->setAnswers($answer);
			$entityManager->persist($user);
			$entityManager->flush();

			return $this->redirectToRoute('ankieta2');
		}
		return $this->render('ankieta/index.html.twig', [
					'form' => $answerForm->createView(),
		]);
	}

	#[Route('/ankieta2', name: 'ankieta2')]

	public function ankieta2(Request $request): Response {
		$entityManager = $this->getDoctrine()->getManager();
		$user = $this->security->getUser();
		$answer = $user->getAnswers();
		$answerForm = $this->createFormBuilder($answer)
				->add('age', IntegerType::class, ['label' => 'Podaj wiek:'])
				->add('dalej', SubmitType::class, ['label' => 'dalej'])
				->getForm();

		$answerForm->handleRequest($request);

		if ($answerForm->isSubmitted() && $answerForm->isValid()) {
			$answer = $answerForm->getData();

			$user = $this->security->getUser();


			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($answer);
			$user->setAnswers($answer);
			$entityManager->persist($user);
			$entityManager->flush();

			return $this->redirectToRoute('koniec');
		}
		return $this->render('ankieta/ankieta2.html.twig', [
					'form' => $answerForm->createView(),
		]);
	}

	#[Route('/koniec', name: 'koniec')]

	public function koniec(): Response {
		return $this->render('ankieta/koniec.html.twig', [
					'wypelniono' => true,
		]);
	}

}
