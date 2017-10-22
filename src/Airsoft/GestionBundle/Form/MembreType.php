<?php

namespace Airsoft\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MembreType extends AbstractType
{
    protected $em;
    protected $selectedEntities;

    public function __construct($em = null, $entities = null)
    {
        $this->em = $em;
        $this->entities = $entities;

//        $this->selectedEntities = $selectedEntities;
//        $this->em->getRepo
//        dump($entities, $this->em->getReference("AirsoftGestionBundle:Club", $entities['tresorier']->getClub()->getId())); die();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMembre' , 'text')
            ->add('prenomMembre', 'text')
            ->add('adresseMembre', 'text')
            ->add('villeMembre', 'text')
            ->add('cpMembre', 'text')
            ->add('emailMembre', 'text')
            ->add('telMembre', 'text')
            ->add('dateMembre', 'datetime')
            ->add('sexe', 'choice', array('choices' => array(
                'Madame'=>'Madame',
                'Monsieur'=>'Monsieur'),
                'multiple' => false,
                'expanded' => false))
            ->add('published', 'checkbox', array('required' => false))
//            ->add('clubs','entity', array(
//                'class' => 'AirsoftGestionBundle:Club',
//                'property' => 'nomClub',
//                'multiple' => true,
//                'expanded' => false, ))
            ->add('adherents','collection',array(
                'by_reference' => true,
                'type'=>new AdherentType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype' => true,
                'options' => array('label' => false)))
            ->add('president', new PresidentType(),array(
                'required' => false))
            ->add('tresorier', new TresorierType(),array(
                'required' => false ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Airsoft\GestionBundle\Entity\Membre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'airsoft_gestionbundle_membre';
    }
}
