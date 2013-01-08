<?php

namespace JVJ\UtilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('JVJUtilBundle:Default:index.html.twig', array('name' => $name));
    }
}
