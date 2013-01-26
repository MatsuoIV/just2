<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $miembros = $em->getRepository('Just2BackendBundle:Member')->findAll();
        $dateJust = $em->getRepository('Just2BackendBundle:DateJust')->indexJust();
        $ocassion = $em->getRepository('Just2BackendBundle:Ocassion')->findAll();

        $dateJustRand = array_rand($ocassion);
        $memberRand = array_rand($miembros, 2);

        $ocassionImage = $ocassion[$dateJustRand]->getId();

        $faceMale = $miembros[$memberRand[0]]->getUser()->getFace();
        $faceFemale = $miembros[$memberRand[1]]->getUser()->getFace();

        return $this->render('Just2FrontendBundle:Default:index.html.twig', array(
                    'faceMale' => $faceMale,
                    'faceFemale' => $faceFemale,
                    'ocassionImage' => $ocassionImage,
                    'dates' => $dateJust,
                        )
        );
    }
}
