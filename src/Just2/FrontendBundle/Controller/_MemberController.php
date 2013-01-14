<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Just2\BackendBundle\Entity\Member;
use Just2\FrontendBundle\Form\MemberType;

class MemberController extends Controller {

    public function showAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        
        $entity = $em->getRepository('Just2BackendBundle:Member')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }
        // $deleteForm = $this->createDeleteForm($id);

        return $this->render('Just2FrontendBundle:Member:member_show.html.twig', array(
                    'entity' => $entity,
                    // 'delete_form' => $deleteForm->createView(),
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

                $editForm = $this->createForm(new MemberType(), $entity);

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

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Member entity.');
        }

        $editForm = $this->createForm(new MemberType(), $entity);  
        $request = $this->getRequest();

        $editForm->bindRequest($request);        
        
        if ($editForm->isValid()) {

            $fileName = $id.'.png';


            if($editForm['file']->getData() != NULL){
                $editForm['file']->getData()->move('images_user', $fileName);
            }

            $em->persist($entity);            
            $em->flush();

            return $this->redirect($this->generateUrl('user_view_show',array('id' => $id)));
            
        }

        
    }
}
