<?php
namespace Just2\FrontendBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Just2\BackendBundle\Entity\Bid;
use Just2\FrontendBundle\Form\BidType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class venueExtension extends \Twig_Extension {

	public function __construct(EntityManager $manager) {
				
		$this->em = $manager;		
	}

	public function getFunctions(){
		return array(
			'getPaises' => new \Twig_Function_Method($this,'getPaises')
			);
	}

	public function getName(){
		return 'Just2Venue';
	}

	public function getPaises(){
		
        include 'conexion.php';
		conectar();
		$consulta=mysql_query("SELECT id, opcion FROM lista_paises");
		desconectar();

		// Voy imprimiendo el primer select compuesto por los paises
		echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
		echo "<option value='0'>Elige</option>";
		while($registro=mysql_fetch_row($consulta))
		{
			echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
		}
		echo "</select>";

        $dateJust = $this->em->getRepository('Just2BackendBundle:DateJust')->indexJust();

        return $dateJust;
    }
}
