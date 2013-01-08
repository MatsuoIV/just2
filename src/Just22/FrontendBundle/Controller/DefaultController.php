<?php

namespace Just2\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Just2FrontendBundle:Default:index.html.twig'
                //array('name' => $name)
                );
    }
}