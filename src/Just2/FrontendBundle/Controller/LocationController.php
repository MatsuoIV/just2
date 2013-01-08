<?php
namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Just2\BackendBundle\Entity\Location;
use Just2\BackendBundle\Entity\Province;
use Just2\BackendBundle\Entity\Locality;
use Just2\BackendBundle\Form\LocationType;

/**
 * @Route("/listByProvince", name="_localityByProvinceId")
 */

class LocationController extends Controller {

public function indexAction() {
    // $em = $this->getDoctrine()->getEntityManager();

    //creamos una entidad del tipo VenueSearch
    $entity = new Location();

    //generamos el formulario conforme esa entidad
    $form = $this->createForm(new LocationType(), $entity);



    return $this->render('Just2FrontendBundle:VenueJust:view.html.twig', array(
        'entity'    => $entity,
        'form'      => $form->createView()));
}

public function getByProvinceId()
{
    $this->em = $this->get('doctrine')->getEntityManager();
    $this->repository = $this->em->getRepository('RunnerMainBundle:Locality');
 
    $provinceId = $this->get('request')->query->get('data');
 
    $localities = $this->repository->findByProvince($provinceId);
 
    $html = '';
    foreach($localities as $locality)
    {
        $html = $html . sprintf("<option value=\"%d\">%s</option>",$locality->getId(), $locality->getName());
    }
 
    return new Response($html);
}

}