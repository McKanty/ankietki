<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
 {

	private $twig;

	public function __construct(Environment $twig) {
		$this->twig = $twig;
	}

	#[Route('/', name: 'homepage')]

	public function index(Request $request): Response {
		return $this->render('user/index.html.twig', [
		]);
    }

	#[Route('/reg', name: 'register')]

	public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response {
		$user = new User();
		$registerForm = $this->createForm(UserFormType::class, $user);

		$registerForm->handleRequest($request);

		if ($registerForm->isSubmitted() && $registerForm->isValid()) {
			$user = $registerForm->getData();

			$entityManager = $this->getDoctrine()->getManager();
			$encoded = $passwordEncoder->encodePassword($user, $user->getPassword());
			$user->setPassword($encoded);
			$entityManager->persist($user);
			$entityManager->flush();
			$this->addFlash('notice', 'Zostałeś poprawnie zarejestrowany, możesz się teraz zalogować :)');

			return $this->redirectToRoute('app_login');
		}

		return $this->render('user/register.html.twig', [
					'registerForm' => $registerForm->createView(),
		]);
	}

}
