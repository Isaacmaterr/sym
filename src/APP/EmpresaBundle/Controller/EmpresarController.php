<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use APP\EmpresaBundle\Entity\Empresar;

/**
 * Empresar controller.
 *
 */
class EmpresarController extends Controller
{
    /**
     * Lists all Empresar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $empresars = $em->getRepository('EmpresaBundle:Empresar')->findAll();

        return $this->render('empresar/index.html.twig', array(
            'empresars' => $empresars,
        ));
    }

    /**
     * Creates a new Empresar entity.
     *
     */
    public function newAction(Request $request)
    {
        $empresar = new Empresar();
        $form = $this->createForm('APP\EmpresaBundle\Form\EmpresarType', $empresar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresar);
            $em->flush();

            return $this->redirectToRoute('empresar_show', array('id' => $empresar->getId()));
        }

        return $this->render('empresar/new.html.twig', array(
            'empresar' => $empresar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Empresar entity.
     *
     */
    public function showAction(Empresar $empresar)
    {
        $deleteForm = $this->createDeleteForm($empresar);

        return $this->render('empresar/show.html.twig', array(
            'empresar' => $empresar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Empresar entity.
     *
     */
    public function editAction(Request $request, Empresar $empresar )
    {
        $deleteForm = $this->createDeleteForm($empresar);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\EmpresarType', $empresar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($empresar);
            $em->flush();

            return $this->redirectToRoute('empresar_edit', array('id' => $empresar->getId()));
        }

        return $this->render('empresar/edit.html.twig', array(
            'empresar' => $empresar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    
    
    
    
    
    
    
      public function minhaempresaAction(Request $request)
    {
          
      $empresar =   $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();
      if($empresar){
       $Form = $this->createForm('APP\EmpresaBundle\Form\EmpresarUsuarioType', $empresar);
       }else{
       $Form = $this->createForm('APP\EmpresaBundle\Form\EmpresarUsuarioType');
 
       }
        $Form->handleRequest($request);
       
        if ($Form->isSubmitted() && $Form->isValid()) {
            $dadosEmpresar = $Form->getData();
            
            $usuario =  $this->get('security.token_storage')->getToken()->getUser();
            $dadosEmpresar->setUsuario($usuario);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($dadosEmpresar);
            $em->flush();

            return $this->redirectToRoute('empresar_minha');
        }

        return $this->render('empresar/minhaempresa.html.twig', array(
            'empresar' => $empresar,
            'form' => $Form->createView(),
          
        ));
    }
    
    
    
    
    
    /**
     * Deletes a Empresar entity.
     *
     */
    public function deleteAction(Request $request, Empresar $empresar)
    {
        $form = $this->createDeleteForm($empresar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($empresar);
            $em->flush();
        }

        return $this->redirectToRoute('empresar_index');
    }

    /**
     * Creates a form to delete a Empresar entity.
     *
     * @param Empresar $empresar The Empresar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Empresar $empresar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empresar_delete', array('id' => $empresar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
