<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\Bid;
use Just2\FrontendBundle\Form\BidType;

class DateJustController extends Controller {

    public function viewAction($id) {
        $date = $this->getDoctrine()
                ->getRepository('Just2BackendBundle:DateJust')
                ->find($id);



        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            
            if ($date->getMember()->getId() == $this->get('security.context')->getToken()->getUser()->getMember()->getId()) {


                return $this->redirect($this->generateUrl('bids_date', array(
                                    'id' => $id,
                                )));
            }


            $memberBidsForDate = $this->getDoctrine()->getRepository('Just2BackendBundle:Bid')
                    ->memberBidsForDate($id, $this->get('security.context')->getToken()->getUser()->getMember()->getId());
           
            
            $highestBid = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->highestBid($id);

            $totalbidsfordate = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->countBidsForDate($id);

            $bid = new Bid();
            $bid->setDateJust($date);
            $formBid = $this->createForm(new BidType(), $bid);

            $request = $this->getRequest();
            $info = $request->query->get('info');

            return $this->render('Just2FrontendBundle:DateJust:view.html.twig', array(
                        'date' => $date,
                        'formbid' => $formBid->createView(),
                        'highestBid' => $highestBid,
                        'info' => $info,
                        'totalbids' => $totalbidsfordate,
                        'mybiddate' => $memberBidsForDate
                    ));
        } else {

            $highestBid = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->highestBid($id);

            $totalbidsfordate = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->countBidsForDate($id);

            $bid = new Bid();
            $bid->setDateJust($date);
            $formBid = $this->createForm(new BidType(), $bid);

            $request = $this->getRequest();
            $info = $request->query->get('info');

            return $this->render('Just2FrontendBundle:DateJust:view.html.twig', array(
                        'date' => $date,
                        'formbid' => $formBid->createView(),
                        'highestBid' => $highestBid,
                        'info' => $info,
                        'totalbids' => $totalbidsfordate,
                        'mybiddate' => $memberBidsForDate = null
                    ));
        }
    }

}

?>
