<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\EmpresaBundle\Entity\Receita;
//use APP\EmpresaBundle\Form\ReceitaType;
use APP\EmpresaBundle\Entity\Parcelas;

/**
 * Receita controller.
 *
 */
class ReceitaController extends Controller {

    /**
     * Lists all Receita entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $empresar = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();
        $receitas = $em->getRepository('EmpresaBundle:Receita')->findBy(['empresa' => $empresar->getId()]);

        return $this->render('receita/index.html.twig', array(
                    'receitas' => $receitas,
        ));
    }

    /**
     * Creates a new Receita entity.
     *
     */
    public function newAction(Request $request) {
        $empresar = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();

        $receitum = new Receita();
        $receitum->setEmpresa($empresar);
        $form = $this->createForm('APP\EmpresaBundle\Form\ReceitaType', $receitum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($receitum);

            foreach ($request->get("form")["parcelas"] as $key => $parcela) {
                $parc = new Parcelas();
                $parc->setNumero($parcela['numero'])
                        ->setValor($parcela['valor'])
                        ->setVencimento($parcela['vencimento'])
                        ->setEmpresa($empresar);
                $parc->setReceita($receitum);

                $em->persist($parc);
            }

            $em->flush();

            return $this->redirectToRoute('receita_show', array('id' => $receitum->getId()));
        }

        return $this->render('receita/new.html.twig', array(
                    'receitum' => $receitum,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Receita entity.
     *
     */
    public function showAction(Receita $receitum) {
        $deleteForm = $this->createDeleteForm($receitum);

        return $this->render('receita/show.html.twig', array(
                    'receitum' => $receitum,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Receita entity.
     *
     */
    public function editAction(Request $request, Receita $receitum) {
        $deleteForm = $this->createDeleteForm($receitum);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\ReceitaType', $receitum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($receitum);
            $em->flush();

            return $this->redirectToRoute('receita_edit', array('id' => $receitum->getId()));
        }

        return $this->render('receita/edit.html.twig', array(
                    'receitum' => $receitum,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Receita entity.
     *
     */
    public function deleteAction(Request $request, Receita $receitum) {
        $form = $this->createDeleteForm($receitum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($receitum);
            $em->flush();
        }

        return $this->redirectToRoute('receita_index');
    }

    /**
     * Creates a form to delete a Receita entity.
     *
     * @param Receita $receitum The Receita entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Receita $receitum) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('receita_delete', array('id' => $receitum->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
