<?php

namespace brutal\DbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('brutalDbBundle:Default:index.html.twig', array('name' => $name));
    }
}
