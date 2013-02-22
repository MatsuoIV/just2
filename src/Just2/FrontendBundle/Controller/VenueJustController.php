<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\Ocassion;
use Just2\BackendBundle\Entity\OcassionVenue;
use Just2\BackendBundle\Entity\DateJust;
use Just2\BackendBundle\Entity\Bid;
use Just2\BackendBundle\Entity\Reservation;
use Just2\BackendBundle\Form\OcassionType;
use Just2\FrontendBundle\Form\VenueSearchType;
use Just2\FrontendBundle\Form\VenueReserveType;

class VenueJustController extends Controller {

    // aca va de argumento $id
    public function indexAction() {

        $form = $this->createForm(new VenueSearchType());
        $request = $this->getRequest();

        if ($request->isMethod('GET')) {
            
        }

        if ($request->isMethod('POST')) {            
            $form->bindRequest($request);           

            if (!$form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $ocassion = $em->getRepository('Just2BackendBundle:Ocassion')->find($form["ocassion"]->getData()->getId());

                if($form["suburb"]->getData() == NULL){
                    $vs = $em->getRepository('Just2BackendBundle:Venue')->getVenueNoSuburb($form["ocassion"]->getData()->getId());
                } else {
                    if($form["distance"]->getData() == NULL){
                        $vs = $em->getRepository('Just2BackendBundle:Venue')->getVenueSuburb($form["ocassion"]->getData()->getId(),$form["suburb"]->getData()->getId()); 
                    } else {                        
                        $vs = $em->getRepository('Just2BackendBundle:Venue')->getVenueSuburbDistance($form["ocassion"]->getData()->getId(),$form["suburb"]->getData()->getId(),$form["distance"]->getData()); 
                    }
                }               

                return $this->render('Just2FrontendBundle:VenueJust:venue_result.html.twig', array(                
                    'vs'    => $vs,
                    'ocassion' => $ocassion
                ));
            } else {
                // Redirect
            }
        }
        return $this->render('Just2FrontendBundle:VenueJust:venue_search.html.twig', array(
            'form'    => $form->createView()
        ));

    }

    public function detailAction($ocassion_id, $venue_id) {

        $em = $this->getDoctrine()->getEntityManager();

        $ocassion = $em->getRepository('Just2BackendBundle:Ocassion')->findBy(array(
            'id' => $ocassion_id
            ));

        $venue = $em->getRepository('Just2BackendBundle:Venue')->findBy(array(
            'id' => $venue_id
            ));

        return $this->render('Just2FrontendBundle:VenueJust:venue_details.html.twig', array(
            'od'    => $ocassion,
            'vd'    => $venue
        ));
        
    }

    public function reserveAction($ocassion_id, $venue_id){

        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $em = $this->getDoctrine()->getEntityManager();            
            $ocassion = $em->getRepository('Just2BackendBundle:Ocassion')->findBy(array(
                'id' => $ocassion_id
                ));
            $venue = $em->getRepository('Just2BackendBundle:Venue')->findBy(array(
                'id' => $venue_id
                ));
            $dateJust = new DateJust();
            $bid = new Bid();
            $reservation = new Reservation();

            $dateReserve = new \DateTime($_POST["venuedate"].$_POST["venuetime"]);
            $dateReserve->modify("-1 day");

            $dateEnd = new \DateTime($_POST["venuedate"]);

            $dateBid = new \DateTime($_POST["venuebid"]);


            $dateJust
                ->setMember($this->get('security.context')->getToken()->getUser()->getMember())
                ->setOcassion($ocassion[0])
                ->setVenue($venue[0])
                ->setDetailDate($ocassion[0]->getName())
                ->setMinPrice($ocassion[0]->getPrice())
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'))
                ->setDateEnd($dateReserve)
                ->setEstate(2)                    
                ;

            $bid
                ->setPrice($ocassion[0]->getPrice())
                ->setMember($this->get('security.context')->getToken()->getUser()->getMember())
                ->setEstate(1)
                ->setCreatedAt($dateBid)
                ->setDateJust($dateJust)
                ;

            $reservation
                ->setVenue($venue[0])
                ->setDateJust($dateJust)
                ->setOcassion($ocassion[0])
                ->setCodeReservation(rand(100000,999999))
                ->setByDate($dateEnd)
                ->setEstate(1)
                ;

            $data = array(
                'venuedate' => $_POST["venuedate"],
                'venuetime' => $_POST["venuetime"],
                'venuebid' => $_POST["venuebid"],
                );

            $em->persist($dateJust);
            $em->persist($bid);
            $em->persist($reservation);

            $em->flush();



            return $this->render('Just2FrontendBundle:VenueJust:venue_reserve.html.twig',array(
                    'venue' => $venue[0]->getName(),
                    'ocassion' => $ocassion[0]->getName(),
                    'location' => $venue[0]->getAddress(),
                    'venuedate' => $_POST["venuedate"],
                    'venuetime' => $_POST["venuetime"],
                    'venuebid' => $_POST["venuebid"],
                    'price' => $ocassion[0]->getPrice()
                ));

        } else {
            return $this->redirect($this->generateUrl('usuario_login'));
        }
    }

    public function printAction($ocassion_id, $venue_id) {

        $em = $this->getDoctrine()->getEntityManager();

        $ocassion = $em->getRepository('Just2BackendBundle:Ocassion')->findBy(array(
            'id' => $ocassion_id
            ));

        $venue = $em->getRepository('Just2BackendBundle:Venue')->findBy(array(
            'id' => $venue_id
            ));

        $html = $this->renderView('Just2FrontendBundle:VenueJust:venue_details.html.twig', array(
            'od'    => $ocassion,
            'vd'    => $venue
        ));

        return new Response(
            $this->get('venue_details.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }


}

?>
