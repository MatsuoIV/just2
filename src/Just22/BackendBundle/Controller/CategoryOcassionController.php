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

use Just2\BackendBundle\Entity\CategoryOcassion;
use Just2\BackendBundle\Form\CategoryOcassionType;

/**
 * CategoryOcassion controller.
 *
 */
class CategoryOcassionController extends Controller
{
    /**
     * Lists all CategoryOcassion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('Just2BackendBundle:CategoryOcassion')->findAll();

        return $this->render('Just2BackendBundle:CategoryOcassion:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a CategoryOcassion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:CategoryOcassion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryOcassion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2BackendBundle:CategoryOcassion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new CategoryOcassion entity.
     *
     */
    public function newAction()
    {
        $entity = new CategoryOcassion();
        $form   = $this->createForm(new CategoryOcassionType(), $entity);


    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:CategoryOcassion:news.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView() ));
    }else{
            return $this->render('Just2BackendBundle:CategoryOcassion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()));
    }

    }


    /**
     * Creates a new CategoryOcassion entity.
     *
     */
    public function createAction()
    {
        $entity  = new CategoryOcassion();
        $request = $this->getRequest();
        $form    = $this->createForm(new CategoryOcassionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoryocassion'));
            
        }

        return $this->render('Just2BackendBundle:CategoryOcassion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing CategoryOcassion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:CategoryOcassion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryOcassion entity.');
        }

        $editForm = $this->createForm(new CategoryOcassionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('Just2BackendBundle:CategoryOcassion:edits.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }else{
        return $this->render('Just2BackendBundle:CategoryOcassion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    }

    /**
     * Edits an existing CategoryOcassion entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:CategoryOcassion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryOcassion entity.');
        }

        $editForm   = $this->createForm(new CategoryOcassionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoryocassion'));
        }

        return $this->render('Just2BackendBundle:CategoryOcassion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CategoryOcassion entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('Just2BackendBundle:CategoryOcassion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CategoryOcassion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoryocassion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
