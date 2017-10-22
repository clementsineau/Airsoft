<?php

namespace Airsoft\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PresidentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('club', 'entity', array('class' => 'AirsoftGestionBundle:Club', 'required' => false))
//            ->add('membre', new MembreType(),array(
//                'required' => false ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Airsoft\GestionBundle\Entity\President'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'airsoft_gestionbundle_president';
    }
}
