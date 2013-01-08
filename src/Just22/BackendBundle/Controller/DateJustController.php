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

use Just2\BackendBundle\Entity\DateJust;
use Just2\BackendBundle\Form\DateJustType;

/**
 * DateJust controller.
 *
 */
class DateJustController extends Controller
{
    /**
     * Lists all DateJust entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('Just2BackendBundle:DateJust')->findAll();

        return $this->render('Just2BackendBundle:DateJust:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a DateJust entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:DateJust')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DateJust entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2BackendBundle:DateJust:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new DateJust entity.
     *
     */
    public function newAction()
    {
        $entity = new DateJust();
        $form   = $this->createForm(new DateJustType(), $entity);


    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:DateJust:news.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView() ));
    }else{
            return $this->render('Just2BackendBundle:DateJust:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()));
    }

    }


    /**
     * Creates a new DateJust entity.
     *
     */
    public function createAction()
    {
        $entity  = new DateJust();
        $request = $this->getRequest();
        $form    = $this->createForm(new DateJustType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('datejust'));
            
        }

        return $this->render('Just2BackendBundle:DateJust:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing DateJust entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:DateJust')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DateJust entity.');
        }

        $editForm = $this->createForm(new DateJustType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:DateJust:edits.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }else{
        return $this->render('Just2BackendBundle:DateJust:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    }

    /**
     * Edits an existing DateJust entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:DateJust')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DateJust entity.');
        }

        $editForm   = $this->createForm(new DateJustType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('datejust'));
        }

        return $this->render('Just2BackendBundle:DateJust:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DateJust entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('Just2BackendBundle:DateJust')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DateJust entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('datejust'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
