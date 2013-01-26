<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\Message;
use Just2\FrontendBundle\Form\MessageType;

class MessageController extends Controller {

    private function deleteMessage($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('Just2BackendBundle:Message')->find($id);
        $entity->setEstate(0);
        $em->persist($entity);
        $em->flush();
        return true;
    }

    private function markReadMessage($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('Just2BackendBundle:Message')->find($id);
        $entity->setEstate(2);
        $em->persist($entity);
        $em->flush();
        return true;
    }

    private function resendMessage($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('Just2BackendBundle:Message')->find($id);


        $message = new Message();
        $message->setEstate(1);
        $message->setBodyMessage($entity->getBodyMessage());
        $message->setCreatedAt(new \DateTime());
        $message->setImessage($entity->getId());
        $message->setMemberFor($entity->getMemberFor());
        $message->setMemberOf($entity->getMemberOf());
        $message->setSubject('Reply - ' . $entity->getSubject());


        $em->persist($message);
        $em->flush();
        return true;
    }

    public function ajaxAction() {
        $request = $this->getRequest();
        $action = $request->query->get('action');
        $idMessage = $request->query->get('message');


        if ($action) {
            switch ($action) {
                case 1:
                    $this->markReadMessage($idMessage);
                    break;
                case 2:
                    $this->resendMessage($idMessage);
                    break;
                case 3:
                    $this->deleteMessage($idMessage);
                    break;
            }
        }

        return new Response('true');
    }

    public function messagesAction() {

        $request = $this->getRequest();
        $action = $request->query->get('action');
        $idMessage = $request->query->get('message');


        if ($action) {
            switch ($action) {
                case 1:
                    $this->markReadMessage($idMessage);
                    break;
                case 2:
                    $this->resendMessage($idMessage);
                    break;
                case 3:
                    $this->deleteMessage($idMessage);
                    break;
            }
        }


        $em = $this->getDoctrine()->getEntityManager();
        $memberId = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

        if ($memberId) {

            $messagesOut = $em->getRepository('Just2BackendBundle:Message')
                    ->sendMessagesIndex($memberId);
            $messagesIn = $em->getRepository('Just2BackendBundle:Message')
                    ->newMessagesIndex($memberId);
            return $this->render('Just2FrontendBundle:User:Message/messages.html.twig', array(
                        'messagesOut' => $messagesOut,
                        'messagesIn' => $messagesIn
                    ))
            ;
        }
    }

    public function receivedAction() {



        $request = $this->getRequest();
        $action = $request->query->get('action');
        $idMessage = $request->query->get('message');


        if ($action) {
            switch ($action) {
                case 1:
                    $this->markReadMessage($idMessage);
                    break;
                case 2:
                    $this->resendMessage($idMessage);
                    break;
                case 3:
                    $this->deleteMessage($idMessage);
                    break;
            }
        }



        $em = $this->getDoctrine()->getEntityManager();
        $memberId = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

        if ($memberId) {
            $messagesIn = $em->getRepository('Just2BackendBundle:Message')
                    ->newMessages($memberId);
            $paginator2 = $this->get('knp_paginator');
            $messagesIn = $paginator2->paginate($messagesIn, $this->getRequest()->query->get('page', 1), 10);


            return $this->render('Just2FrontendBundle:User:Message/received.html.twig', array(
                        'messagesIn' => $messagesIn
                    ));
        }
    }

    public function sentAction() {
        $request = $this->getRequest();
        $action = $request->query->get('action');
        $idMessage = $request->query->get('message');


        if ($action) {
            switch ($action) {
                case 1:
                    $this->markReadMessage($idMessage);
                    break;
                case 2:
                    $this->resendMessage($idMessage);
                    break;
                case 3:
                    $this->deleteMessage($idMessage);
                    break;
            }
        }


        $em = $this->getDoctrine()->getEntityManager();
        $memberId = $this->get('security.context')->getToken()->getUser()->getMember()->getId();

        if ($memberId) {
            $messagesOut = $em->getRepository('Just2BackendBundle:Message')
                    ->sendMessages($memberId);
            $paginator2 = $this->get('knp_paginator');
            $messagesOut = $paginator2->paginate($messagesOut, $this->getRequest()->query->get('page', 1), 10);


            return $this->render('Just2FrontendBundle:User:Message/sent.html.twig', array(
                        'messagesOut' => $messagesOut
                    ));
        }
    }

    public function newAction($id, $for) {
        $entity = new Message();

        $em = $this->getDoctrine()->getEntityManager();
        $dateJust = $em->getRepository('Just2BackendBundle:DateJust')->find($id);
        $memberFor = $em->getRepository('Just2BackendBundle:Member')->find($for);

        $entity->setDateJust($dateJust);
        $entity->setMemberFor($memberFor);

        $form = $this->createForm(new MessageType(), $entity);

        $peticion = $this->getRequest();

        if ($peticion->getMethod() == 'POST') {

            $form->bindRequest($peticion);
            if ($form->isValid()) {
                if ($dateJust->getEstate() == 3 or $dateJust->getEstate() == 4 or $dateJust->getEstate() == 5) {
                    $entity->setCreatedAt(new \DateTime());
                    $entity->setEstate(1);
                    $entity->setImessage(0);
                    $member = $em->getRepository('Just2BackendBundle:Member')->find($this->get('security.context')->getToken()->getUser()->getMember()->getId());
                    $entity->setMemberOf($member);

                    $em->persist($entity);
                    $em->flush();

                    return $this->redirect($this->generateUrl('message'));
                } else {
                    return $this->redirect($this->generateUrl('message', array(
                                        'info' => 'Date Just Expired!!! Not Sent',
                                    )));
                }
            }
        }


        return $this->render('Just2FrontendBundle:User:Message/new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

}

?>
