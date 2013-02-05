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
use Symfony\Component\Security\Core\SecurityContext;
use JVJ\UserBundle\Entity\User;
use JVJ\UserBundle\Form\UserType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    /**
     * Lists all User entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JVJUserBundle:User')->findAll();

        return $this->render('JVJUserBundle:User:index.html.twig', array(
                    'entities' => $entities
                ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JVJUserBundle:User:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction() {
        $entity = new User();
        $form = $this->createForm(new UserType(), $entity);


        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            return $this->render('JVJUserBundle:User:news.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView()));
        } else {
            return $this->render('JVJUserBundle:User:new.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView()));
        }
    }

    /**
     * Creates a new User entity.
     *
     */
    public function createAction() {
        $entity = new User();
        $request = $this->getRequest();
        $form = $this->createForm(new UserType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user'));
        }

        return $this->render('JVJUserBundle:User:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
                ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);




        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            return $this->render('JVJUserBundle:User:edits.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ));
        } else {
            return $this->render('JVJUserBundle:User:edit.html.twig', array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    ));
        }
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JVJUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user'));
        }

        return $this->render('JVJUserBundle:User:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JVJUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    public function loginAction() {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR, $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        return $this->render('JVJUserBundle:User:login.html.twig', array('error' => $error));
    }

    public function passRecoveryAction() {

        $submit = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        
        $form = $this->createForm(new UserType());

        if($submit->getMethod() == 'POST'){
            $form->bindRequest($submit);            
            $user = $em->getRepository('JVJUserBundle:User')->findOneBy(array(
                'username'  =>  $form->getData()->getUsername()
                ));
            //cuerpo del mensaje
            $body = "Reset your password: http://www.just2test.ioio.com.au/recover/" . $user->getEmail() . "/" . $user->getCodeActivation();
            if ($this->sendMail($user->getEmail(), 'Restore Password - Just2', $body, null)) {
                return $this->render('Just2FrontendBundle:VenueJust:prueba.html.twig',array(
                    'data' => "Datos enviados"
                    ));   
            } else {
                return $this->render('Just2FrontendBundle:VenueJust:prueba.html.twig',array(
                    'data' => "Datos NO enviados"
                    )); 
            }                     
        }
        return $this->render('Just2FrontendBundle:User:passRecovery.html.twig',array(
            'form' => $form->createView()
            ));
    }

    public function passResetAction($email, $codeActivate) {
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('JVJUserBundle:User')->userActivation($email, $codeActivate);
        // print_r($user);return;
        $form = $this->createForm(new UserType(), $user);
       
        return $this->render('Just2FrontendBundle:User:passReset.html.twig',array(
            'form' => $form->createView(),
            ));        
    }

    public function passUpdateAction() {
        $submit = $this->getRequest();
        if($submit->getMethod() == 'POST'){
            return $this->render('Just2FrontendBundle:VenueJust:prueba.html.twig',array(
                'data' => print_r($submit->get('jvj_userbundle_usertype'))
                ));
        }
    }

    public function sendMail($to, $subject, $body, $theme = null) {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From: Just2 \r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";


        if (is_array($to)) {
            $send = 0;
            $notsend = 0;
            foreach ($to as $i => $to) {
                if (mail($to, $subject, $this->body($body), $headers)) {
                    $send = +1;
                } else {
                    $notsend = +1;
                }
            }

            if ($send >= 1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (mail($to, $subject, $this->body($body), $headers)) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function body($body, $theme = null) {
        return $this->render('Just2FrontendBundle:Util:notifications.html.twig', array(
                    'body' => $body,
                    'theme' => $theme
                ));
    }
}
