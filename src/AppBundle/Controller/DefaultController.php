<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    
    /**
     * @Route("/teste", name="teste")
     */
    public function testeAction(Request $request)
    {
        $user2 = $this->get('security.token_storage')->getToken()->getUser()->getTelefones();
        foreach ($user2 as $value) {
            var_dump($value->getUsuario()->getNome());
        }
       
        // replace this example code with whatever you need
        return $this->render('default/teste.html.twig', [
           'eu'=>'isaac',
        ]);
    }
    
}
