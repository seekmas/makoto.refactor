<?php

namespace Web\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CasesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , 'text')
            ->add('content' , 'textarea')
            ->add('category')
            ->add('keywords')
            ->add('layout')
        ;

        $builder->add('save','submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\BackBundle\Entity\Cases'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'web_backbundle_cases';
    }
}
