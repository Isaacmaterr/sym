<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\EmpresaBundle\Entity\Categoria;
use Symfony\Component\Debug\Debug;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller {

    /**
     * Lists all Categoria entities.
     *
     */
    public function indexAction(Request $request) {
        $empresaid = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa()->getId();

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM EmpresaBundle:Categoria a where a.empresar = :empresar";
        $query = $em->createQuery($dql);
        $query->setParameter('empresar', $empresaid);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, /* query NOT result */ 
                $request->query->getInt('page', 1)/* page number */,
                2/* limit per page */
        );
       

        /** $em2 = $this->getDoctrine()->getManager();
          $categorias = $em2->getRepository('EmpresaBundle:Categoria')->findBy(['empresar' => $empresaid]);* */
        return $this->render('categoria/index.html.twig', array(
                    'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new Categoria entity.
     *
     */
    public function newAction(Request $request) {
        $empresaid = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa()->getId();
        $categoria = new Categoria();
        $categoria->setEmpresar($empresaid);
        $form = $this->createForm('APP\EmpresaBundle\Form\CategoriaType', $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $categoria = $form->getData();


            $empresa = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();
            $categoria->setEmpresar($empresa);
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();

            return $this->redirectToRoute('categoria_show', array('id' => $empresa->getId()));
        }

        return $this->render('categoria/new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoria entity.
     *
     */
    public function showAction(Categoria $categorium) {
        $deleteForm = $this->createDeleteForm($categorium);

        return $this->render('categoria/show.html.twig', array(
                    'categorium' => $categorium,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction(Request $request, Categoria $categorium) {
        $deleteForm = $this->createDeleteForm($categorium);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\CategoriaType', $categorium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorium);
            $em->flush();

            return $this->redirectToRoute('categoria_edit', array('id' => $categorium->getId()));
        }

        return $this->render('categoria/edit.html.twig', array(
                    'categorium' => $categorium,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categoria entity.
     *
     */
    public function deleteAction(Request $request, Categoria $categorium) {
        $form = $this->createDeleteForm($categorium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorium);
            $em->flush();
        }

        return $this->redirectToRoute('categoria_index');
    }

    /**
     * Creates a form to delete a Categoria entity.
     *
     * @param Categoria $categorium The Categoria entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categoria $categorium) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('categoria_delete', array('id' => $categorium->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
