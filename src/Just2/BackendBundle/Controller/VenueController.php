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

use Just2\BackendBundle\Entity\Venue;
use Just2\BackendBundle\Form\VenueType;

/**
 * Venue controller.
 *
 */
class VenueController extends Controller
{
    /**
     * Lists all Venue entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('Just2BackendBundle:Venue')->findAll();

        return $this->render('Just2BackendBundle:Venue:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Venue entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2BackendBundle:Venue:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Venue entity.
     *
     */
    public function newAction()
    {
        $entity = new Venue();
        $form   = $this->createForm(new VenueType(), $entity);


    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:Venue:news.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView() ));
    }else{
            return $this->render('Just2BackendBundle:Venue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()));
    }

    }


    /**
     * Creates a new Venue entity.
     *
     */
    public function createAction()
    {
        $entity  = new Venue();
        $request = $this->getRequest();
        $form    = $this->createForm(new VenueType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venue'));
            
        }

        return $this->render('Just2BackendBundle:Venue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Venue entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm = $this->createForm(new VenueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:Venue:edits.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }else{
        return $this->render('Just2BackendBundle:Venue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    }

    /**
     * Edits an existing Venue entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm   = $this->createForm(new VenueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venue'));
        }

        return $this->render('Just2BackendBundle:Venue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Venue entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('Just2BackendBundle:Venue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venue'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
