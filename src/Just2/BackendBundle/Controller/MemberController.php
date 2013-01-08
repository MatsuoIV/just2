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
use Just2\BackendBundle\Entity\Member;
use Just2\BackendBundle\Form\MemberType;

/**
 * Member controller.
 *
 */
class MemberController extends Controller {

    /**
     * Lists all Member entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('Just2BackendBundle:Member')->findAll();

        return $this->render('Just2BackendBundle:Member:index.html.twig', array(
                    'entities' => $entities
                ));
    }

    /**
     * Finds and displays a Member entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2BackendBundle:Member:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Displays a form to create a new Member entity.
     *
     */
    public function newAction() {
        $entity = new Member();
        $form = $this->createForm(new MemberType(), $entity);


        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            return $this->render('Just2BackendBundle:Member:news.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView()));
        } else {
            return $this->render('Just2BackendBundle:Member:new.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView()));
        }
    }

    /**
     * Creates a new Member entity.
     *
     */
    public function createAction() {
        $entity = new Member();
        $request = $this->getRequest();
        $form = $this->createForm(new MemberType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();

            // Completar las propiedades que el usuario no rellena en el formulario
            $entity->getUser()->setSalt(md5(time()));

            $encoder = $this->get('security.encoder_factory')->getEncoder($entity->getUser());
            
            $passwordCodificado = $encoder->encodePassword(
                    $entity->getUser()->getPassword(), $entity->getUser()->getSalt()
            );


            $entity->getUser()->setPassword($passwordCodificado);
            
            $codeActivation = $entity->getUser()->generateCodeActivation(40, false, true, false);
            
            $entity->getUser()->setCodeActivation($codeActivation);

            $em->persist($entity);
            $em->persist($entity->getUser());
            $em->flush();           
            
            return $this->redirect($this->generateUrl('member'));
        }

        return $this->render('Just2BackendBundle:Member:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Displays a form to edit an existing Member entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createForm(new MemberType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            return $this->render('Just2BackendBundle:Member:edits.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ));
        } else {
            return $this->render('Just2BackendBundle:Member:edit.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ));
        }
    }

    /**
     * Edits an existing Member entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createForm(new MemberType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('member'));
        }

        return $this->render('Just2BackendBundle:Member:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Member entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Member entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('member'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
