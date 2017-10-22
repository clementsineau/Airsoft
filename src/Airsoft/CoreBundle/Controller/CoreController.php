<?php
/**
 * Created by PhpStorm.
 * User: Chichi
 * Date: 21/12/2015
 * Time: 09:43
 */

namespace Airsoft\CoreBundle\Controller;

use Airsoft\GestionBundle\Entity\Membre;
use Airsoft\GestionBundle\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class CoreController extends  Controller
{
    public function indexAction()
    {
        $titre = "Page d'accueil de notre site";

//        $repository = $this->getDoctrine()->getManager()->getRepository('AirsoftGestionBundle:Club');
//
//        $listClubAccueil = $repository->findAll();'accueilclubs'=>$listClubAccueil
        return $this->render('AirsoftCoreBundle::layout.html.twig', array('titre' => $titre,));

    }

    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()->add('info', "La page contact n'est pas encore disponible. Merci de revenir plus tard.");

        return $this->redirect($this->generateUrl('airsoft_core_homepage'));
    }
}