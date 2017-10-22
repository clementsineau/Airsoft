<?php

namespace Airsoft\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomClub', 'text')
            ->add('adresseClub', 'text')
            ->add('villeClub', 'text')
            ->add('cpClub', 'text')
            ->add('emailClub', 'email')
            ->add('telClub', 'text')
            ->add('dateClub', 'date')
            ->add('published', 'checkbox',array('required' => false))
//            ->add('image', new ImageType())
            /*
             * Rappel :
             * - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
             * - 2e argument : type du champ, ici « collection » qui est une liste de quelque chose
             * - 3e argument : tableau d'options du champ
             */
            ->add('membres', 'collection', array(
                'by_reference' => false,
                'type' => new MembreType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'options' => array('label' => false)
            ))
//            ->add('', new AdherentType())
            ->add('updatedAt', 'date')
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Airsoft\GestionBundle\Entity\Club'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'airsoft_gestionbundle_club';
    }
}
