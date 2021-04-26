<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class UserController extends AbstractController
 {

	private $twig;

	public function __construct(Environment $twig) {
		$this->twig = $twig;
	}

	#[Route('/', name: 'homepage')]

	public function index(Request $request): Response {
		$user = new User();
		$loginForm = $this->createForm(UserFormType::class, $user);
		$registerForm = $this->createForm(UserFormType::class, $user);
		return $this->render('user/index.html.twig', [
            'loginForm' => $loginForm->createView(),
			'registerForm' => $registerForm->createView(),
		]);
    }
}
