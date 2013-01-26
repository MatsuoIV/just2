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
              
        // $em = $this->getDoctrine()->getEntityManager();
        // $ocassion = new Ocassion();
        // $form = $this->createForm(new OcassionType(), $ocassion);
        // $request = $this->getRequest();

        $form = $this->createForm(new VenueSearchType());
        $request = $this->getRequest();

        // $formSearch->bindRequest($peticion);

        // $formData = $peticion->request->get('just2_backendbundle_ocassiontype');        
        //var_dump($peticion->request->all());

        if ($request->isMethod('POST')) {            
            $form->bindRequest($request);           

            if (!$form->isValid()) {                

                // $params = $this->getRequest()->request->all();
                // $my_params = $params['just2_backendbundle_ocassiontype'];
                // $my_id = (int) $my_params['name'];

                $em = $this->getDoctrine()->getEntityManager();

                // $repo = $em->getRepository('Just2BackendBundle:OcassionVenue')->findBy(array(
                //     'ocassion' => $my_id
                //     ));
                if($form["suburb"]->getData() == NULL){
                    $repo = $em->getRepository('Just2BackendBundle:OcassionVenue')->getVenueNoSuburb($form["ocassion"]->getData()->getId());
                } else {
                    if($form["distance"]->getData() == NULL){
                        $repo = $em->getRepository('Just2BackendBundle:OcassionVenue')->getVenueSuburb($form["ocassion"]->getData()->getId(),$form["suburb"]->getData()->getId()); 
                    } else {                        
                        $repo = $em->getRepository('Just2BackendBundle:OcassionVenue')->getVenueSuburbDistance($form["ocassion"]->getData()->getId(),$form["suburb"]->getData()->getId(),$form["distance"]->getData()); 
                    }
                }
                //formulario
                // $reserveForm = $this->createForm(new VenueReserveType());

                return $this->render('Just2FrontendBundle:VenueJust:venue_result.html.twig', array(                
                    'vs'    => $repo,                    
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

            $dateReserve = new \DateTime($_POST["venuedate"]);
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
                ->setEstate(1)                    
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
                    'data' => $data
                ));

        } else {
            return $this->redirect($this->generateUrl('usuario_login'));
        }
    }


}

?>
