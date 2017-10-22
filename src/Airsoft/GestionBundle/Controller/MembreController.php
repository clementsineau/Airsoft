<?php

namespace Airsoft\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Airsoft\GestionBundle\Entity\Membre;
use Airsoft\GestionBundle\Entity\Adherent;
use Airsoft\GestionBundle\Form\MembreType;

/**
 * Membre controller.
 *
 */
class MembreController extends Controller
{
    /**
     * Lists all Membre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $membres = $em->getRepository('AirsoftGestionBundle:Membre')->findAll();

        $club = $em->getRepository('AirsoftGestionBundle:Club')->findAll();


        $listAdherent = $em->getRepository('AirsoftGestionBundle:Adherent')->findAll();
        return $this->render('AirsoftGestionBundle:Membre:index.html.twig', array(
            'adherent'=>$listAdherent,
            'membres' => $membres,
            'clubs' => $club
        ));
    }
    /**
     * Creates a new Membre entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Membre();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
//        dump($entity);
        if ($form->isValid()) {
//            echo '<pre>';
//            dump($form->getData());
//            echo '</pre>';
//            die();
            $em = $this->getDoctrine()->getManager();

            if(!empty($entity->getTresorier())){
                $entity->getTresorier()->setMembre($entity);
            }
            if(!empty($entity->getPresident())){
                $entity->getPresident()->setMembre($entity);
            }
            if(!empty($entity->getAdherents())){
                foreach($entity->getAdherents() as &$adherent)
                {
                    $adherent->setMembre($entity);
                }
            }

            $em->persist($entity);
            $em->flush();
//            die();
            $request->getSession()->getFlashBag()->add('notice', 'Membre bien ajouté.');
            return $this->redirect($this->generateUrl('membre_show', array('id' => $entity->getId())));
        }

        return $this->render('AirsoftGestionBundle:Membre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a form to create a Membre entity.
     *
     * @param Membre $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Membre $entity)
    {
        $form = $this->createForm(new MembreType($entity), $entity, array(
            'action' => $this->generateUrl('membre_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Membre entity.
     *
     */
    public function newAction()
    {
        $entity = new Membre();
        $entity -> addAdherent((new Adherent()));
        $form   = $this->createCreateForm($entity);

        return $this->render('AirsoftGestionBundle:Membre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Membre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Membre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Membre:show.html.twig', array(

            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Membre entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Membre')->find($id);
//        $entity -> addAdherent((new Adherent()));
//        $adherent = $em->getRepository('AirsoftGestionBundle:Tresorier')->findBy(array('membre' => $entity));
//        dump($adherent, $entity); die();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membre entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);


        return $this->render('AirsoftGestionBundle:Membre:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Membre entity.
    *
    * @param Membre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Membre $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = array(
            'membre' => $entity,
            'tresorier' => $em->getRepository('AirsoftGestionBundle:Tresorier')->findOneByMembre($entity),
            'president' => $em->getRepository('AirsoftGestionBundle:President')->findOneByMembre($entity),
            'adherent'  => $em->getRepository('AirsoftGestionBundle:Adherent') ->findOneByMembre($entity)
        );
        $form = $this->createForm(new MembreType($this->getDoctrine()->getManager(), $entities), $entity, array(
            'action' => $this->generateUrl('membre_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Membre entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Membre')->find($id);
//        $entity -> addAdherent(new AdherentType());
//        $tresorier = $em->getRepository('AirsoftGestionBundle:Tresorier')->findOneByMembre($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Membre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

//        dump($entity);die();

        if ($editForm->isValid()) {
//            $tresorier->setClub($entity->getTresorier());

            if(!empty($entity->getTresorier())){
                $entity->getTresorier()->setMembre($entity);
            }
//            dump($entity->getTresorier());
//            dump($entity->getPresident());
            if(!empty($entity->getPresident())){
                $entity->getPresident()->setMembre($entity);
            }
            if(!empty($entity->getAdherents())){
                foreach($entity->getAdherents() as &$adherent)
                {
                    $adherent->setMembre($entity);
                }
            }
//            dump($entity); die();
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Membre bien modifié.');
            return $this->redirect($this->generateUrl('membre_show', array('id' => $id)));
        }

        return $this->render('AirsoftGestionBundle:Membre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Membre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AirsoftGestionBundle:Membre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Membre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('membre'));
    }

    /**
     * Creates a form to delete a Membre entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('membre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer'))
            ->getForm()
        ;
    }
}
