<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\EmpresaBundle\Entity\Clientes;
use APP\UsuarioBundle\Entity\Endereco;
use APP\UsuarioBundle\Entity\Telefone ;

use APP\EmpresaBundle\Form\ClientesType;

/**
 * Clientes controller.
 *
 */
class ClientesController extends Controller {

    /**
     * Lists all Clientes entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('EmpresaBundle:Clientes')->findAll();

        return $this->render('clientes/index.html.twig', array(
                    'clientes' => $clientes,
        ));
    }

    /**
     * Creates a new Clientes entity.
     *
     */
    public function newAction(Request $request) {
        $cliente = new Clientes();
        $form = $this->createForm('APP\EmpresaBundle\Form\ClientesType', $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
  
            $em = $this->getDoctrine()->getManager();
            $empresar = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();
            $endereco = new Endereco();
            $endereco->setEndereco($form->get('endereco')->getData());
            $endereco->setCep($form->get('cep')->getData());
            $endereco->setBairro($form->get('bairro')->getData());
            $endereco->setUf($form->get('bairro')->getData());
            $em->persist($endereco);


            $cliente->setEmpresar($empresar);
            $cliente->setEndereco($endereco);
            $em->persist($cliente);
            
            foreach($request->get("form")["telefones"] as $telefone){
             
                   $telefoneSave = new Telefone();
                    $telefoneSave->setNumero($telefone)
                            ->setWhatzap(1)
                            ->setCliente($cliente);

               
                $em->persist($telefoneSave);
            }
            
            $em->flush();

            return $this->redirectToRoute('clientes_show', array('id' => $cliente->getId()));
        }

        return $this->render('clientes/new.html.twig', array(
                    'cliente' => $cliente,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Clientes entity.
     *
     */
    public function showAction(Clientes $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);
      
        return $this->render('clientes/show.html.twig', array(
                    'cliente' => $cliente,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Clientes entity.
     *
     */
    public function editAction(Request $request, Clientes $cliente) {
        $deleteForm = $this->createDeleteForm($cliente);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\ClientesType', $cliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirectToRoute('clientes_edit', array('id' => $cliente->getId()));
        }

        return $this->render('clientes/edit.html.twig', array(
                    'cliente' => $cliente,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Clientes entity.
     *
     */
    public function deleteAction(Request $request, Clientes $cliente) {
        $form = $this->createDeleteForm($cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cliente);
            $em->flush();
        }

        return $this->redirectToRoute('clientes_index');
    }

    /**
     * Creates a form to delete a Clientes entity.
     *
     * @param Clientes $cliente The Clientes entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Clientes $cliente) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('clientes_delete', array('id' => $cliente->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
