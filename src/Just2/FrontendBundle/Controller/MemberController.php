<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Just2\BackendBundle\Entity\Member;
use Just2\BackendBundle\Entity\Interest;
use Just2\FrontendBundle\Form\ProfileType;

class MemberController extends Controller {

    public function showAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        
        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);
        $interest = $em->getRepository('Just2BackendBundle:Interest')->getInterestsByMember($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }
        
        if ($this->get('security.context')->isGranted('ROLE_USER')) {

            if($this->get('security.context')->getToken()->getUser()->getMember()->getId() == $id){

                return $this->render('Just2FrontendBundle:Member:member_show2.html.twig', array(
                            'entity' => $entity,
                            'interest' => $interest
                        ));
            }
        }

        return $this->render('Just2FrontendBundle:Member:member_show.html.twig', array(
                            'entity' => $entity,
                            'interest' => $interest
                        ));
    }

    public function editAction($id) {

        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            if($this->get('security.context')->getToken()->getUser()->getMember()->getId() == $id){

                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Member entity.');
                }

                $editForm = $this->createForm(new ProfileType(), $entity);
                $request = $this->get('request');

                if ($request->isXmlHttpRequest()) {
                    return $this->render('Just2FrontendBundle:Member:member_edits.html.twig', array(
                                'entity' => $entity,
                                'edit_form' => $editForm->createView()                    
                            ));
                } else {
                    return $this->render('Just2FrontendBundle:Member:member_edit.html.twig', array(
                                'entity' => $entity,
                                'edit_form' => $editForm->createView()                        
                            ));
                }
            }
        }         
        return $this->redirect($this->generateUrl('user_view_show',array('id' => $id)));        
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);
        $user = $em->getRepository('JVJUserBundle:User')->find($entity->getUser()->getId());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createForm(new ProfileType(), $entity, array('id' => $id));  
        $request = $this->getRequest();

        $editForm->bindRequest($request);        
        
        if ($editForm->isValid()) {

            $em->persist($entity);
            $em->flush();
            $user->setFace($entity->getPath());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_view_show',array('id' => $id)));            
        }        
    }
}
