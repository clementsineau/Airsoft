<?php

namespace Airsoft\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AirsoftGestionBundle:Default:index.html.twig', array('name' => $name));
    }
}
