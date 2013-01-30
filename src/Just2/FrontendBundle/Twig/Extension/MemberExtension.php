<?php
namespace Just2\FrontendBundle\Twig\Extension;

// use Just2\BackendBundle\Entity\Bid;
// use Just2\FrontendBundle\Form\BidType;
// use Symfony\Component\DependencyInjection\ContainerInterface;

class memberExtension extends \Twig_Extension {

	public function getFunctions(){
		return array(
			'getGender' => new \Twig_Function_Method($this,'getGender'),
			'getDatePreference' => new \Twig_Function_Method($this,'getDatePreference'),
			'getParams' => new \Twig_Function_Method($this,'getParams'),
            'getAge' => new \Twig_Function_Method($this,'getAge')
			);
	}

	public function getName(){
		return 'Just2Member';
	}

	public function getGender($var){        
        switch ($var) {
        	case 'm':
        		echo "Male";
        		break;
        	case 'f':
        		echo "Female";
        		break;
        }
        return;
    }

    public function getDatePreference($var) {
    	switch ($var) {
    		case 'm':
    			echo "Men";
    			break;    		
    		case 'f':
        		echo "Women";
        		break;
    	}
    }

    public function getParams($var) {
    	switch ($var) {
    		case 'yes':
    			echo "Yes";
    			break;    		
    		case 'no':
    			echo "No";
    			break;    		
    		case 'doubt':
    			echo "Don't specify";
    			break;
    		case 'tba':
    			echo "To be Announced";
    			break;
    	}
    }

    public function getAge($var) {
        list($y,$m,$d) = explode("-",$var);
        //Variables año, mes, día
        $y_diff  = date("Y") - $y;
        $m_diff = date("m") - $m;
        $d_diff   = date("d") - $d;
        if ($d_diff < 0 || $m_diff < 0)
            $y_diff--;
        return $y_diff;
    }

}
