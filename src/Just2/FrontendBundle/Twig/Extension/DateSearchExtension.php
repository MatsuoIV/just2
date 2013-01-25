<?php
namespace Just2\FrontendBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Bid;
use Just2\FrontendBundle\Form\BidType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class dateSearchExtension extends \Twig_Extension {

	private $em;
	
	public function __construct(EntityManager $manager,ContainerInterface $container) {
				
		$this->em = $manager;
		$this->container = $container;
	}

	public function getFunctions(){
		return array(
			'highestBid' => new \Twig_Function_Method($this,'highestBid'),
			'totalbidsfordate' => new \Twig_Function_Method($this,'totalbidsfordate'),
			'formBid' => new \Twig_Function_Method($this,'formBid'),
			);
	}

	public function highestBid($dateId){	

		$highestBid = $this->em->getRepository('Just2BackendBundle:Bid')->highestBid($dateId);
		if($highestBid){			
			return $highestBid->getPrice();
		} else {			
			return NULL;
		}
	}

	public function totalbidsfordate($dateId){

		$totalbidsfordate = $this->em->getRepository('Just2BackendBundle:Bid')->countBidsForDate($dateId);
		return $totalbidsfordate;
	}


	public function formBid($date){

		// var_dump($date);
		$bid = new Bid();
        $bid->setDateJust($date);
        $formBid = $this->container->get('form.factory')->create(new BidType(),$bid);
        

        return $formBid->createView();
	}

	public function getName(){
		return 'Just2';
	}
}
