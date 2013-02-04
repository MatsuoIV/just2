<?php
namespace Just2\FrontendBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Interest;
// use Just2\FrontendBundle\Form\BidType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class panelExtension extends \Twig_Extension {

	private $em;
	
	public function __construct(EntityManager $manager) {				
		$this->em = $manager;
	}

	public function getFunctions(){
		return array(
			'getMembers' => new \Twig_Function_Method($this,'getMembers'),
			);
	}

	public function getMembers($memberId, $interestId){	

		$members = $this->em->getRepository('Just2BackendBundle:Member')->getMembersByInterest($memberId, $interestId);

		if($members){			
			return $members;
		} else {			
			return NULL;
		}
	}

	public function getName(){
		return 'Just2Panel';
	}
}