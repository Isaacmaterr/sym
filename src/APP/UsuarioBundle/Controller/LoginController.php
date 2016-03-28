<?php

namespace APP\UsuarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Login controller.
 * @Template()
 * @Route("/")
 */
class LoginController extends Controller {

    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');
        $authChecker = $this->container->get('security.authorization_checker');
       

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'security/login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
                        )
        );
    }

    /**
     * @Route("/login_chech",name="login_chech")
     */
    public function loginCheckAction() {
        
    }

    /**
     * @Route("/logout",name="logout")
     */
    public function logoutAction() {
        
    }

  

}
