<?php

namespace Airsoft\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Airsoft\GestionBundle\Entity\President;
use Airsoft\GestionBundle\Form\PresidentType;

/**
 * President controller.
 *
 */
class PresidentController extends Controller
{

    /**
     * Lists all President entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AirsoftGestionBundle:President')->findAll();

        return $this->render('AirsoftGestionBundle:President:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new President entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new President();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);



        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('president_show', array('id' => $entity->getId())));
        }

        return $this->render('AirsoftGestionBundle:President:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a President entity.
     *
     * @param President $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(President $entity)
    {
        $form = $this->createForm(new PresidentType(), $entity, array(
            'action' => $this->generateUrl('president_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new President entity.
     *
     */
    public function newAction()
    {
        $entity = new President();
        $form   = $this->createCreateForm($entity);

        return $this->render('AirsoftGestionBundle:President:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a President entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:President')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find President entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:President:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing President entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:President')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find President entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AirsoftGestionBundle:President:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a President entity.
    *
    * @param President $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(President $entity)
    {
        $form = $this->createForm(new PresidentType(), $entity, array(
            'action' => $this->generateUrl('president_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing President entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AirsoftGestionBundle:President')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find President entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('president_edit', array('id' => $id)));
        }

        return $this->render('AirsoftGestionBundle:President:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a President entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AirsoftGestionBundle:President')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find President entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('president'));
    }

    /**
     * Creates a form to delete a President entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('president_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
