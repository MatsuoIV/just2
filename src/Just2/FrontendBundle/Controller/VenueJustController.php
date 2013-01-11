<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Just2\BackendBundle\Entity\Ocassion;
use Just2\BackendBundle\Entity\OcassionVenue;
use Just2\BackendBundle\Form\OcassionType;

class VenueJustController extends Controller {

    // aca va de argumento $id
    public function indexAction() {
              
        // $em = $this->getDoctrine()->getEntityManager();
        $ocassion = new Ocassion();
        $form = $this->createForm(new OcassionType(), $ocassion);
        $request = $this->getRequest();

        // $formSearch->bindRequest($peticion);

        // $formData = $peticion->request->get('just2_backendbundle_ocassiontype');        
        //var_dump($peticion->request->all());

        if ($request->isMethod('POST')) {
            //$form->bind($request);
            $form->bindRequest($request);

            if (!$form->isValid()) {

                

                $params = $this->getRequest()->request->all();
                $my_params = $params['just2_backendbundle_ocassiontype'];
                $my_id = (int) $my_params['name'];




                $em = $this->getDoctrine()->getEntityManager();

                $repo = $em->getRepository('Just2BackendBundle:OcassionVenue')->findBy(array(
                    'ocassion' => $my_id
                    ));

                // print_r($repo->getVenue());

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

        // print_r($ocassion);
        // print_r($venue);

        return $this->render('Just2FrontendBundle:VenueJust:venue_details.html.twig', array(
            'od'    => $ocassion,
            'vd'    => $venue
        ));
    }


}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
