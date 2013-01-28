<?php
namespace Just2\FrontendBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Bid;
use Just2\FrontendBundle\Form\BidType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class indexExtension extends \Twig_Extension {

	public function __construct(EntityManager $manager) {
				
		$this->em = $manager;		
	}

	public function getFunctions(){
		return array(
			'dates' => new \Twig_Function_Method($this,'dates')
			);
	}

	public function getName(){
		return 'Just2Util';
	}

	public function dates(){
        $dateJust = $this->em->getRepository('Just2BackendBundle:DateJust')->indexJust();

        return $dateJust;
    }
}
