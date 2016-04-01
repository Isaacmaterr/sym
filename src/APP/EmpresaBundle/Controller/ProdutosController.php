<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use APP\EmpresaBundle\Entity\Produtos;
use APP\EmpresaBundle\Form\ProdutosType;

/**
 * Produtos controller.
 *
 */
class ProdutosController extends Controller
{
    /**
     * Lists all Produtos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('EmpresaBundle:Produtos')->findAll();

        return $this->render('produtos/index.html.twig', array(
            'produtos' => $produtos,
        ));
    }

    /**
     * Creates a new Produtos entity.
     *
     */
    public function newAction(Request $request)
    {
        $produto = new Produtos();
        $form = $this->createForm('APP\EmpresaBundle\Form\ProdutosType', $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produtos_show', array('id' => $produto->getId()));
        }

        return $this->render('produtos/new.html.twig', array(
            'produto' => $produto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produtos entity.
     *
     */
    public function showAction(Produtos $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);

        return $this->render('produtos/show.html.twig', array(
            'produto' => $produto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produtos entity.
     *
     */
    public function editAction(Request $request, Produtos $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\ProdutosType', $produto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produtos_edit', array('id' => $produto->getId()));
        }

        return $this->render('produtos/edit.html.twig', array(
            'produto' => $produto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produtos entity.
     *
     */
    public function deleteAction(Request $request, Produtos $produto)
    {
        $form = $this->createDeleteForm($produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produto);
            $em->flush();
        }

        return $this->redirectToRoute('produtos_index');
    }

    /**
     * Creates a form to delete a Produtos entity.
     *
     * @param Produtos $produto The Produtos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produtos $produto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produtos_delete', array('id' => $produto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
