<?php
namespace Just2\FrontendBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;

class testExtension extends \Twig_Extension {

	// public function __construct(){

	// }

	public function __construct(EntityManager $manager) {
        $this->em = $manager;        
    }

	public function getFunctions(){
		return array(
			'loadDates' => new \Twig_Function_Method($this,'loadDates')
			);
	}

	public function loadDates(){
		$em = $this->em->getDoctrine()->getEntityManager();

		$date = $this->$em->getRepository('Just2BackendBundle:DateJust')->find(1);

		print_r($date);
		return;

		return $this->render('Just2FrontendBundle:DateJust:test.html.twig', array(
            'date'    => $date->getMember()
        ));

	}

	public function getName(){
		return 'Just2';
	}

}
