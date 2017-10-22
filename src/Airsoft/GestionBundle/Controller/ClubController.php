<?php

namespace Airsoft\GestionBundle\Controller;

use Airsoft\GestionBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Airsoft\GestionBundle\Entity\Club;
use Airsoft\GestionBundle\Entity\Adherent;
use Airsoft\GestionBundle\Entity\Membre;
use Airsoft\GestionBundle\Entity\Image;
use Airsoft\GestionBundle\Form\ClubType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Club controller.
 *
 */
class ClubController extends Controller
{
    /**
     * Lists all Club entities.
     *
     */
    public function indexAction($page)//
    {
        if($page < 1)
        {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante');
        }
        // Ici je fixe le nombre d'annonces par page à 3
        // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
        $nbPerPage = 3;

        // Ici, on récupérera la liste des annonces, puis on la passera au template
        // Pour récupérer la liste de toutes les clubs : on utilise findAll()
        $listClubs = $this->getDoctrine()
            ->getManager()
            ->getRepository('AirsoftGestionBundle:Club')
            ->getClubs($page, $nbPerPage)
        ;
        // On calcule le nombre total de pages grâce au count($listClubs) qui retourne le nombre total d'annonces
        $nbPages = ceil(count($listClubs)/$nbPerPage);

        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('AirsoftGestionBundle:Club:index.html.twig', array(
//            'entities' => $entities,
            'listClubs' => $listClubs,
            'nbPages'     => $nbPages,
            'page'        => $page
        ));
    }
    /**
     * Creates a new Club entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Club();
        $entity -> addAdherent((new Adherent()));

        $form = $this->createCreateForm($entity);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Club bien enregistré.');
            return $this->redirect($this->generateUrl('club_show', array(
                'id' => $entity->getId(),
                ))
            );
        }

        return $this->render('AirsoftGestionBundle:Club:new.html.twig', array(
            'entity' => $entity,

            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Club entity.
     *
     * @param Club $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Club $entity)
    {
        $form = $this->createForm(new ClubType(), $entity, array(
            'action' => $this->generateUrl('club_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Club entity.
     *
     */
    public function newAction()
    {
        $entity = new Club();
//        $membre = new Membre();
        $form   = $this->createCreateForm($entity);

//              $form2   = $this->createCreateForm($membre);

        return $this->render('AirsoftGestionBundle:Club:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
//            'form2' => $form2->createView(),
//            'membre' => $membre
        ));
    }

    /**
     * Finds and displays a Club entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Club')->find($id);

        //Afin de récupérer tous les membres mais uniquement de ce club
        $repository = $this->getDoctrine()->getManager()->getRepository('AirsoftGestionBundle:Club');
        $club = $repository->find($id);

        $membres = $club->getMembres();


        $entities = $em->getRepository('AirsoftGestionBundle:Club')->findAll();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Club:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'membres' => $membres,
            'entities'      => $entities,
        ));
    }

    /**
     * Displays a form to edit an existing Club entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Club')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }
//        // La méthode findAll retourne toutes les catégories de la base de données
//        $listCategories = $em->getRepository('AirsoftGestionBundle:Category')->findAll();
//
//        // On boucle sur les catégories pour les lier à l'annonce
//        foreach ($listCategories as $category) {
//            $entity->addCategory($category);
//        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);


        return $this->render('AirsoftGestionBundle:Club:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Club entity.
    *
    * @param Club $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Club $entity)
    {
        $form = $this->createForm(new ClubType(), $entity, array(
            'action' => $this->generateUrl('club_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Club entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Club')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Club bien modifié.');
            return $this->redirect($this->generateUrl('club_show', array('id' => $id)));
        }

        return $this->render('AirsoftGestionBundle:Club:show.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Club entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AirsoftGestionBundle:Club')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Club entity.');
            }

            $em->remove($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add('delete', 'Club bien supprimé.');
        }

        return $this->redirect($this->generateUrl('club'));
    }

    /**
     * Creates a form to delete a Club entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('club_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer Club'))
            ->getForm()
        ;
    }

    public function menuAction($limit)
    {
        $listClubs = $this->getDoctrine()
            ->getManager()
            ->getRepository('AirsoftGestionBundle:Club')
            ->findBy(
                array(),                 // Pas de critère
                array('dateClub' => 'desc'), // On trie par date décroissante
                $limit                // On sélectionne $limit annonces à partir du premier
            );

        return $this->render('AirsoftGestionBundle:Club:menu.html.twig', array(
            'listClubs' => $listClubs
        ));
    }

}
