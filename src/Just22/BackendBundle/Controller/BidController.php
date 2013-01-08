<?php

/**
 * Proyect:      Just2
 * Enterprise:   WCORPSAC
 * Generate By:  JVilcapaza
 * mail:         javiervilcapaza@gmail.com
 * Version:      1.0
 */

namespace Just2\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Just2\BackendBundle\Entity\Bid;
use Just2\BackendBundle\Form\BidType;

/**
 * Bid controller.
 *
 */
class BidController extends Controller
{
    /**
     * Lists all Bid entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('Just2BackendBundle:Bid')->findAll();

        return $this->render('Just2BackendBundle:Bid:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Bid entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Bid')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bid entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2BackendBundle:Bid:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Bid entity.
     *
     */
    public function newAction()
    {
        $entity = new Bid();
        $form   = $this->createForm(new BidType(), $entity);


    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:Bid:news.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView() ));
    }else{
            return $this->render('Just2BackendBundle:Bid:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()));
    }

    }


    /**
     * Creates a new Bid entity.
     *
     */
    public function createAction()
    {
        $entity  = new Bid();
        $request = $this->getRequest();
        $form    = $this->createForm(new BidType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bid'));
            
        }

        return $this->render('Just2BackendBundle:Bid:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Bid entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Bid')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bid entity.');
        }

        $editForm = $this->createForm(new BidType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:Bid:edits.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }else{
        return $this->render('Just2BackendBundle:Bid:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    }

    /**
     * Edits an existing Bid entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Bid')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bid entity.');
        }

        $editForm   = $this->createForm(new BidType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bid'));
        }

        return $this->render('Just2BackendBundle:Bid:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Bid entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('Just2BackendBundle:Bid')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bid entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bid'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
