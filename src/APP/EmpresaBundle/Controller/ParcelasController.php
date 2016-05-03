<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use APP\EmpresaBundle\Entity\Parcelas;
use APP\EmpresaBundle\Form\ParcelasType;

/**
 * Parcelas controller.
 *
 */
class ParcelasController extends Controller
{
    /**
     * Lists all Parcelas entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parcelas = $em->getRepository('EmpresaBundle:Parcelas')->findAll();

        return $this->render('parcelas/index.html.twig', array(
            'parcelas' => $parcelas,
        ));
    }

    /**
     * Creates a new Parcelas entity.
     *
     */
    public function newAction(Request $request)
    {
        $parcela = new Parcelas();
        $form = $this->createForm('APP\EmpresaBundle\Form\ParcelasType', $parcela);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parcela);
            $em->flush();

            return $this->redirectToRoute('parcelas_show', array('id' => $parcela->getId()));
        }

        return $this->render('parcelas/new.html.twig', array(
            'parcela' => $parcela,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Parcelas entity.
     *
     */
    public function showAction(Parcelas $parcela)
    {
        $deleteForm = $this->createDeleteForm($parcela);

        return $this->render('parcelas/show.html.twig', array(
            'parcela' => $parcela,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Parcelas entity.
     *
     */
    public function editAction(Request $request, Parcelas $parcela)
    {
        $deleteForm = $this->createDeleteForm($parcela);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\ParcelasType', $parcela);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parcela);
            $em->flush();

            return $this->redirectToRoute('parcelas_edit', array('id' => $parcela->getId()));
        }

        return $this->render('parcelas/edit.html.twig', array(
            'parcela' => $parcela,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Parcelas entity.
     *
     */
    public function deleteAction(Request $request, Parcelas $parcela)
    {
        $form = $this->createDeleteForm($parcela);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parcela);
            $em->flush();
        }

        return $this->redirectToRoute('parcelas_index');
    }

    /**
     * Creates a form to delete a Parcelas entity.
     *
     * @param Parcelas $parcela The Parcelas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Parcelas $parcela)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parcelas_delete', array('id' => $parcela->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
