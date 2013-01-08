<?php

namespace JVJ\PlantillaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('JVJPlantillaBundle:Default:index.html.twig', array('name' => $name));
    }
        public function helpAction()
    {
        return $this->render('JVJPlantillaBundle:Default:help.html.twig');
    }
}
