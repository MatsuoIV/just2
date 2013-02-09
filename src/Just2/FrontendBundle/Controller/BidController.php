<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\Bid;
use Just2\FrontendBundle\Form\BidType;

class BidController extends Controller {

    public function bidAction() {

        $bid = new Bid();

        $formBid = $this->createForm(new BidType(), $bid);

        $peticion = $this->getRequest();
        $formData = $peticion->request->get('just2_frontendbundle_bidtype', 'no se obtuvo');

        //       return new Response($price['dateJust']);

        $em = $this->getDoctrine()->getEntityManager();

        if ($peticion->getMethod() == 'POST' & $this->get('security.context')->getToken()->getUser()!=null) {

            $formBid->bindRequest($peticion);

            if ($formBid->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $date = $em->getRepository('Just2BackendBundle:DateJust')
                        ->activeAppointment($formData['dateJust']);
                $member = $usuario = $this->get('security.context')->getToken()->getUser(); //user in session
                
                $memberRejectered = $this->getDoctrine()
                        ->getRepository('Just2BackendBundle:Bid')
                        ->rejectered($member->getMember()->getId(),$date->getId());


    //        return new Response($memberRejectered);
            

                $highestBid = $this->getDoctrine()
                        ->getRepository('Just2BackendBundle:Bid')
                        ->highestBid($date->getId());

                if ($highestBid) {
                    $currentBid = $highestBid->getPrice();
                } else {
                    $currentBid = $date->getMinPrice();
                }

                if ($currentBid + $this->container->getParameter('Just2.MinimunRangeBids') <= $formData['price'] &  $memberRejectered==0) {

                    $bid->setDateJust($date);
                    $bid->setMember($member->getMember());
                    $bid->setEstate(2);

                    $em->persist($bid);
                    $em->flush();

                    return $this->redirect($this->generateUrl('date_view', array(
                                        'id' => $bid->getDateJust()->getId(),
                                        'info' => 'se ejecuto con exito'
                                    )));
                } else {
                    if ($date->getMinPrice() + $this->container->getParameter('Just2.MinimunRangeBids') > $formData['price']) {

                        return $this->redirect($this->generateUrl('date_view', array(
                                            'id' => $formData['dateJust'],
                                            'info' => 'el rango de apuesta minima es de 5'
                                        )));
                    }
                    if($memberRejectered==1){
                        return $this->redirect($this->generateUrl('date_view', array(
                                            'id' => $formData['dateJust'],
                                            'info' => 'Uds Ya ha sido rechazado'
                                        )));
                    }
                        
                    //return new Response("algo fallo " . $date->getMinPrice() . $this->container->getParameter('Just2.MinimunRangeBids') . $formData['price']);
                }
            } else {
                
            }
        }
        
    }

    public function actionsAction($date, $bid, $action) {
        
    }

    public function myProposalsAction() {
        
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
