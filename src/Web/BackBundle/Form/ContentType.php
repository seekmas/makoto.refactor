<?php

namespace Web\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , 'text')
            ->add('catalog')
            ->add('content' , 'textarea')
            ->add('vector' , 'text')
            ->add('addonBlockOne' , 'text' , ['required' => false])
            ->add('addonBlockTwo' , 'text' , ['required' => false])
            ->add('addonBlockThree' , 'text' , ['required' => false])
        ;

        $builder->add('save' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\BackBundle\Entity\Content'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'web_backbundle_content';
    }
}
