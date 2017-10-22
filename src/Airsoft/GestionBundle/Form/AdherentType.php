<?php

namespace Airsoft\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdherentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateLicence' , 'date')
            ->add('clubs','entity', array(
                'class' => 'AirsoftGestionBundle:Club',
                'property' => 'nomClub',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ))
            ->add('membre','entity', array(
                'class' => 'AirsoftGestionBundle:Membre',
                'property' => 'nomMembre',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ))
//            ->add('membre', 'collection')
//            ->add('membre', new MembreType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Airsoft\GestionBundle\Entity\Adherent'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'airsoft_gestionbundle_adherent';
    }
}
