<?php

namespace APP\EmpresaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use APP\EmpresaBundle\Entity\Fotos;
use APP\EmpresaBundle\Form\FotosType;

/**
 * Fotos controller.
 *
 */
class FotosController extends Controller
{
    /**
     * Lists all Fotos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$fotos = $em->getRepository('EmpresaBundle:Fotos')->findBy(['empresarbanner not '=> 'null']);
         $em = $em->getRepository('EmpresaBundle:Fotos');
         
      
      $fotos =   $em->trasBanners();
       
         return $this->render('fotos/index.html.twig', array(
            'fotos' => $fotos,
        ));
    }

    /**
     * Creates a new Fotos entity.
     *
     */
    public function newAction(Request $request)
    {
        $foto = new Fotos();
        $form = $this->createForm('APP\EmpresaBundle\Form\FotosType', $foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empresar = $this->get('security.token_storage')->getToken()->getUser()->getEmpresa();
             $foto->setFile($foto->getArquivo());
             $foto->setEmpresarbanner($empresar);
             $foto->setPrincipal(0);
             $foto->setCaminho('uploads/Banners');
             $foto->upload();
            
             $em = $this->getDoctrine()->getManager();
            $em->persist($foto);
            $em->flush();

            return $this->redirectToRoute('fotos_show', array('id' => $foto->getId()));
        }

        return $this->render('fotos/new.html.twig', array(
            'foto' => $foto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fotos entity.
     *
     */
    public function showAction(Fotos $foto)
    {
        $deleteForm = $this->createDeleteForm($foto);

        return $this->render('fotos/show.html.twig', array(
            'foto' => $foto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fotos entity.
     *
     */
    public function editAction(Request $request, Fotos $foto)
    {
        $deleteForm = $this->createDeleteForm($foto);
        $editForm = $this->createForm('APP\EmpresaBundle\Form\FotosType', $foto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($foto);
            $em->flush();

            return $this->redirectToRoute('fotos_edit', array('id' => $foto->getId()));
        }

        return $this->render('fotos/edit.html.twig', array(
            'foto' => $foto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Fotos entity.
     *
     */
    public function deleteAction(Request $request, Fotos $foto)
    {
        $form = $this->createDeleteForm($foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($foto);
            $em->flush();
        }

        return $this->redirectToRoute('fotos_index');
    }

    /**
     * Creates a form to delete a Fotos entity.
     *
     * @param Fotos $foto The Fotos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fotos $foto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fotos_delete', array('id' => $foto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
