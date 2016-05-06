<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use APP\EmpresaBundle\Entity\Servicos;
use APP\EmpresaBundle\Form\ServicosType;

/**
 * Servicos controller.
 *
 */
class ServicosController extends Controller
{
    /**
     * Lists all Servicos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicos = $em->getRepository('EmpresaBundle:Servicos')->findAll();

        return $this->render('servicos/index.html.twig', array(
            'servicos' => $servicos,
        ));
    }

    /**
     * Creates a new Servicos entity.
     *
     */
    public function newAction(Request $request)
    {
        $servico = new Servicos();
        $form = $this->createForm('APP\EmpresaBundle\Form\ServicosType', $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servico);
            $em->flush();

            return $this->redirectToRoute('servicos_show', array('id' => $servico->getId()));
        }

        return $this->render('servicos/new.html.twig', array(
            'servico' => $servico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Servicos entity.
     *
     */
    public function showAction(Servicos $servico)
    {
        $deleteForm = $this->createDeleteForm($servico);

        return $this->render('servicos/show.html.twig', array(
            'servico' => $servico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Servicos entity.
     *
     */
    public function editAction(Request $request, Servicos $servico)
    {
        $deleteForm = $this->createDeleteForm($servico);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\ServicosType', $servico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servico);
            $em->flush();

            return $this->redirectToRoute('servicos_edit', array('id' => $servico->getId()));
        }

        return $this->render('servicos/edit.html.twig', array(
            'servico' => $servico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Servicos entity.
     *
     */
    public function deleteAction(Request $request, Servicos $servico)
    {
        $form = $this->createDeleteForm($servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servico);
            $em->flush();
        }

        return $this->redirectToRoute('servicos_index');
    }

    /**
     * Creates a form to delete a Servicos entity.
     *
     * @param Servicos $servico The Servicos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Servicos $servico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicos_delete', array('id' => $servico->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
