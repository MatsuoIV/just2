<?php

/**
 * Proyect:      Just2
 * Enterprise:   WCORPSAC
 * Generate By:  JVilcapaza
 * mail:         javiervilcapaza@gmail.com
 * Version:      1.0
 */

namespace JVJ\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use JVJ\UserBundle\Entity\Role;
use JVJ\UserBundle\Form\RoleType;

/**
 * Role controller.
 *
 */
class RoleController extends Controller
{
    /**
     * Lists all Role entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JVJUserBundle:Role')->findAll();

        return $this->render('JVJUserBundle:Role:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Role entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JVJUserBundle:Role:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Role entity.
     *
     */
    public function newAction()
    {
        $entity = new Role();
        $form   = $this->createForm(new RoleType(), $entity);


    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('JVJUserBundle:Role:news.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView() ));
    }else{
            return $this->render('JVJUserBundle:Role:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()));
    }

    }


    /**
     * Creates a new Role entity.
     *
     */
    public function createAction()
    {
        $entity  = new Role();
        $request = $this->getRequest();
        $form    = $this->createForm(new RoleType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('role'));
            
        }

        return $this->render('JVJUserBundle:Role:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Role entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $editForm = $this->createForm(new RoleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




    $request = $this->get('request');
    
    if ( $request->isXmlHttpRequest() ) {  
        return $this->render('JVJUserBundle:Role:edits.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }else{
        return $this->render('JVJUserBundle:Role:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    }

    /**
     * Edits an existing Role entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:Role')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Role entity.');
        }

        $editForm   = $this->createForm(new RoleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('role'));
        }

        return $this->render('JVJUserBundle:Role:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Role entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JVJUserBundle:Role')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Role entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('role'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
