<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends Controller {
  
  /**
   * @Route("/login", name="login")
   */
  public function loginAction(Request $request, AuthenticationUtils $authenticationUtils) : Response {
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('@App/auth/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
  }
  
}
