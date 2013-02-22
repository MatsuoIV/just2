<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\DateJust;
use Just2\BackendBundle\Entity\Auction;
use Just2\BackendBundle\Entity\Bid;
use Just2\BackendBundle\Entity\Member;
use Just2\FrontendBundle\Form\BidType;
use Just2\FrontendBundle\Form\DateSearchType;

class DateJustController extends Controller {

    public function viewAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $date = $em->getRepository('Just2BackendBundle:DateJust')->find($id);

        switch ($date->getEstate()) {
            case 1:
                return $this->estateBooked($date);
            case 2:
                $toDate = new \DateTime();
                if ($toDate < $date->getDateEnd()) {
                    return $this->estateAuction($date);
                } else {
                    $totalbidsfordate = $this->getDoctrine()
                            ->getRepository('Just2BackendBundle:Bid')
                            ->countBidsForDate($date->getId());
                    if ($totalbidsfordate == 0 or $totalbidsfordate == null) {

                        $em = $this->getDoctrine()->getEntityManager();
                        $date = $em->getRepository('Just2BackendBundle:DateJust')
                                ->find($id);
                        $date->setEstate(5);
                        $em->persist($date);
                        $em->flush();
                        $this->viewAction($id);
                    } else {
                        $em = $this->getDoctrine()->getEntityManager();
                        $date = $em->getRepository('Just2BackendBundle:DateJust')
                                ->find($id);
                        $date->setEstate(3);
                        $em->persist($date);

                        $auction = new Auction();

                        $auction->setDateJust($date);

                        $reservation = $em->getRepository('Just2BackendBundle:Reservation')
                                ->dateJustReservation($date->getId());
                        $auction->setReservation($reservation->getId());
                        $auction->setState(1);

                        $highestBid = $this->getDoctrine()
                                ->getRepository('Just2BackendBundle:Bid')
                                ->highestBid($date->getId());

                        $auction->setWinningBid($highestBid->getPrice());
                        $auction->setWinningMember($highestBid->getMember());

                        $reservation->setEstate(2);

                        $em->persist($reservation);

                        $em->persist($auction);
                        $em->flush();

                        return $this->viewAction($id);
                    }
                }
            case 3:
                return $this->estateBookedEnd($date);

            case 5:
                return $this->estateBookedEnd($date);

            case 6:
                return $this->estateBookedEnd($date);

            case 4:
                $toDate = new \DateTime();
                $em = $this->getDoctrine()->getEntityManager();
                $reservation = $em->getRepository('Just2BackendBundle:Reservation')
                        ->dateJustReservation($id);

                if ($toDate > $reservation->getByDate()) {
                    $date = $em->getRepository('Just2BackendBundle:DateJust')
                            ->find($id);
                    $date->setEstate(6);
                    $em->persist($date);

                    $reservation->setEstate(4);

                    $em->persist($reservation);

                    $em->flush();

                    $this->viewAction($id);
                } else {
                    return $this->estateBookedEnd($date);
                }
        }
    }

    public function estateBookedEnd(DateJust $date) {

        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            if ($date->getMember()->getId() == $this->get('security.context')->getToken()->getUser()->getMember()->getId()) {
                return $retorn = $this->redirect($this->generateUrl('date_finished', array(
                            'id' => $date->getId(),
                        )));
            } else {
                $auction = $this->getDoctrine()
                        ->getRepository('Just2BackendBundle:Auction')
                        ->findOneByDateJust($date);
                if($auction){
                    if ($auction->getWinningMember()->getId() == $this->get('security.context')->getToken()->getUser()->getMember()->getId()) {                        
                        $memberBidsForDate = $this->getDoctrine()->getRepository('Just2BackendBundle:Bid')
                                ->memberBidsForDate($date->getId(), $this->get('security.context')->getToken()->getUser()->getMember()->getId());

                        $totalbidsfordate = $this->getDoctrine()
                                ->getRepository('Just2BackendBundle:Bid')
                                ->countBidsForDate($date->getId());

                        $request = $this->getRequest();
                        $info = $request->query->get('info');

                        $return = $this->render('Just2FrontendBundle:User:DateJust/wining.html.twig', array(
                            'date' => $date,
                            'totalbids' => $totalbidsfordate,
                            'mybiddate' => $memberBidsForDate,
                            'auction' => $auction,
                            'info' => $info
                                ));
                        return $return;
                }
            }

            if ($date->getEstate() == 5) {

                $request = $this->getRequest();
                $info = $request->query->get('info');

                return $return = $this->render('Just2FrontendBundle:DateJust:without.html.twig', array(
                    'date' => $date,
                    'info' => $info,
                        ));
            }
            
            $memberBidsForDate = $this->getDoctrine()->getRepository('Just2BackendBundle:Bid')
                    ->memberBidsForDate($date->getId(), $this->get('security.context')->getToken()->getUser()->getMember()->getId());

            $totalbidsfordate = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->countBidsForDate($date->getId());


            $request = $this->getRequest();
            $info = $request->query->get('info');

            $return = $this->render('Just2FrontendBundle:DateJust:justEnd.html.twig', array(
                'date' => $date,
                'totalbids' => $totalbidsfordate,
                'mybiddate' => $memberBidsForDate,
                'auction' => $auction,
                'info' => $info
                    ));
            return $return;
            }
        } else {

            if ($date->getEstate() == 5) {

                $request = $this->getRequest();
                $info = $request->query->get('info');

                return $return = $this->render('Just2FrontendBundle:DateJust:without.html.twig', array(
                    'date' => $date,
                    'info' => $info,
                        ));
            } else {


                $auction = $this->getDoctrine()
                        ->getRepository('Just2BackendBundle:Auction')
                        ->findOneByDateJust($date);


                $totalbidsfordate = $this->getDoctrine()
                        ->getRepository('Just2BackendBundle:Bid')
                        ->countBidsForDate($date->getId());


                $request = $this->getRequest();
                $info = $request->query->get('info');

                $return = $this->render('Just2FrontendBundle:DateJust:justEnd.html.twig', array(
                    'date' => $date,
                    'totalbids' => $totalbidsfordate,
                    'mybiddate' => $memberBidsForDate = 0,
                    'auction' => $auction,
                    'info' => $info
                        ));
                return $return;
            }
        }
    }

    public function estateWithout(DateJust $date) {
        
    }

    public function estateAuction(DateJust $date) {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            if ($date->getMember()->getId() == $this->get('security.context')->getToken()->getUser()->getMember()->getId()) {


                return $retorn = $this->redirect($this->generateUrl('bids_date', array(
                            'id' => $date->getId(),
                        )));
            }


            $memberBidsForDate = $this->getDoctrine()->getRepository('Just2BackendBundle:Bid')
                    ->memberBidsForDate($date->getId(), $this->get('security.context')->getToken()->getUser()->getMember()->getId());


            $highestBid = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->highestBid($date->getId());

            $totalbidsfordate = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->countBidsForDate($date->getId());

            $bid = new Bid();
            $bid->setDateJust($date);
            $formBid = $this->createForm(new BidType(), $bid);

            $request = $this->getRequest();
            $info = $request->query->get('info');

            return $return = $this->render('Just2FrontendBundle:DateJust:view.html.twig', array(
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
                    ->highestBid($date->getId());

            $totalbidsfordate = $this->getDoctrine()
                    ->getRepository('Just2BackendBundle:Bid')
                    ->countBidsForDate($date->getId());

            $bid = new Bid();
            $bid->setDateJust($date);
            $formBid = $this->createForm(new BidType(), $bid);

            $request = $this->getRequest();
            $info = $request->query->get('info');

            $return = $this->render('Just2FrontendBundle:DateJust:view.html.twig', array(
                'date' => $date,
                'formbid' => $formBid->createView(),
                'highestBid' => $highestBid,
                'info' => $info,
                'totalbids' => $totalbidsfordate,
                'mybiddate' => $memberBidsForDate = 0,
                    ));
            return $return;
        }
    }
    public function searchAction() {
              
        $form = $this->createForm(new DateSearchType());
        $request = $this->getRequest();
        $message = "";

        if ($request->isMethod('POST')) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();

                $date = $em->getRepository('Just2BackendBundle:DateJust')->searchDates($form["interested"]->getData(), $form["gender"]->getData());                
                
                if($date != NULL) {
                    if ($this->get('security.context')->isGranted('ROLE_USER')) {
                        return $this->render('Just2FrontendBundle:DateJust:date_results.html.twig', array(
                                'date' => $date,
                                'member' => $this->get('security.context')->getToken()->getUser()->getMember()->getId()
                            ));
                    } else {
                        return $this->render('Just2FrontendBundle:DateJust:date_results.html.twig', array(
                                'date' => $date,
                                'member' => NULL                                
                            ));
                    }
                } else {
                    $message = "No results";
                }
            } else {
                //:v
            }           

        }
        return $this->render('Just2FrontendBundle:DateJust:date_search.html.twig', array(
            'form'    => $form->createView(),            
            'message' => $message
        ));

    }

    public function pdfAction(){
        $format = $this->getRequest()->getRequestFormat();
        return $this->render('Just2FrontendBundle:Default:index.'.$format.'.twig');
    }


}

?>
