<?php

namespace Airsoft\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Airsoft\GestionBundle\Entity\Tresorier;
use Airsoft\GestionBundle\Form\TresorierType;

/**
 * Tresorier controller.
 *
 */
class TresorierController extends Controller
{

    /**
     * Lists all Tresorier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AirsoftGestionBundle:Tresorier')->findAll();

        return $this->render('AirsoftGestionBundle:Tresorier:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tresorier entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tresorier();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tresorier_show', array('id' => $entity->getId())));
        }

        return $this->render('AirsoftGestionBundle:Tresorier:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tresorier entity.
     *
     * @param Tresorier $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tresorier $entity)
    {
        $form = $this->createForm(new TresorierType(), $entity, array(
            'action' => $this->generateUrl('tresorier_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tresorier entity.
     *
     */
    public function newAction()
    {
        $entity = new Tresorier();
        $form   = $this->createCreateForm($entity);

        return $this->render('AirsoftGestionBundle:Tresorier:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tresorier entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Tresorier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tresorier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Tresorier:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tresorier entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Tresorier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tresorier entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:Tresorier:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tresorier entity.
    *
    * @param Tresorier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tresorier $entity)
    {
        $form = $this->createForm(new TresorierType(), $entity, array(
            'action' => $this->generateUrl('tresorier_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tresorier entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:Tresorier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tresorier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tresorier_edit', array('id' => $id)));
        }

        return $this->render('AirsoftGestionBundle:Tresorier:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tresorier entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AirsoftGestionBundle:Tresorier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tresorier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tresorier'));
    }

    /**
     * Creates a form to delete a Tresorier entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tresorier_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
