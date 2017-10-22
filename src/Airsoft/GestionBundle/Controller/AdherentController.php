<?php

namespace Airsoft\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Airsoft\GestionBundle\Entity\Adherent;
use Airsoft\GestionBundle\Form\AdherentType;
use Airsoft\GestionBundle\Form\MembreType;
use Airsoft\GestionBundle\Entity\Membre;

/**
 * Adherent controller.
 *
 */
class AdherentController extends Controller
{

    /**
     * Lists all Adherent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AirsoftGestionBundle:Adherent')->findAll();

        return $this->render('AirsoftGestionBundle:Adherent:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Adherent entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Adherent();
        $form = $this->createCreateForm($entity);

        $membre = new Membre();
        $form2 = $this->createCreateForm($membre);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setMembre($membre);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adherent_show', array('id' => $entity->getId())));
        }



        return $this->render('AirsoftGestionBundle:Adherent:new.html.twig', array(
            'membre' => $membre,
            'entity' => $entity,
            'form'   => $form->createView(),
            'form2' => $form2->createView()
        ));
    }

    /**
     * Creates a form to create a Adherent entity.
     *
     * @param Adherent $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Adherent $entity)
    {
        $form = $this->createForm(new AdherentType(), $entity, array(
            'action' => $this->generateUrl('adherent_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Adherent entity.
     *
     */
    public function newAction()
    {
        $entity = new Adherent();

        $form   = $this->createCreateForm($entity);


        return $this->render('AirsoftGestionBundle:Adherent:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Adherent entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Adherent:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Adherent entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Adherent:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Adherent entity.
    *
    * @param Adherent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Adherent $entity)
    {
        $form = $this->createForm(new AdherentType(), $entity, array(
            'action' => $this->generateUrl('adherent_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Adherent entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Adherent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adherent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('adherent_show', array('id' => $id)));
        }

        return $this->render('AirsoftGestionBundle:Adherent:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Adherent entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AirsoftGestionBundle:Adherent')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Adherent entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('adherent'));
    }

    /**
     * Creates a form to delete a Adherent entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adherent_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
