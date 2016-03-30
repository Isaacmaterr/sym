<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace APP\UsuarioBundle\Controller;

/**
 * Description of UsuarioController
 *
 * @author isaac
 */
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use APP\UsuarioBundle\Entity\Usuario;
use APP\UsuarioBundle\Entity\Endereco;
use APP\UsuarioBundle\Entity\Telefone;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Usuarios controller.
 * @Template()
 * @Route("/")
 */
class UsuarioController extends Controller {

    /**
     * @Route("/admin/cadastro",name="cadastro_usuario")
     * @Template()
     */
    public function cadastroAction(Request $request) {
        $sec = $this->get('security.authorization_checker');

       /* if (!$sec->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException("somente admin");
        }*/
        $form = $this->createForm('APP\UsuarioBundle\Forms\UsuarioType');
        if ("POST" == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid($form)) {
                $session = new Session();

                $en = $this->getDoctrine()->getEntityManager();
                $data = $form->getData();


                $endereco = new Endereco();
                $endereco->setBairro($data['bairro'])
                        ->setCep($data['cep'])
                        ->setEndereco($data['endereco'])
                        ->setUf($data['uf']);
                $en->persist($endereco);

                $usuario = new Usuario();
                $usuario->setEmail($data['email'])
                        ->setNome($data['nome'])
                        ->setRoles([$data['tipo']]);

                $usuario->setEndereco($endereco);
                $usuario->setPassword($this->encodePassword($usuario, $data['password']));
                $en->persist($usuario);


                foreach ($data['telefones'] as $tel) {
                    $telefone = new Telefone();
                    $telefone->setNumero($tel)
                            ->setWhatzap(1)
                            ->setUsuario($usuario);

                    $en->persist($telefone);
                }





                $en->flush();



                $session->getFlashBag()->add('success', 'cadastrado com sucesso');
                return $this->redirect($this->generateUrl('painel_usuario'));
            }
        }


        return ["form" => $form->createView()];
    }

    private function encodePassword($user, $plainPassWord) {
        $encode = $this->get("security.encoder_factory")
                ->getEncoder($user);

        return $encode->encodePassword($plainPassWord, $user->getSalt());
    }

    /**
     * 
     * @Route("/painel",name="painel_usuario")
     * @Template()
     */
     
    public function painelAction() {
        return [];
    }

     /**
     *  
     * @Route("/admin/painelAdmin",name="painel_admin")
     * @Template()
     */
     public function painelAdmAction() {
        return [];
    }
    
}
