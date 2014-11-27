<?php

namespace Web\BackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsfeedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject')
            ->add('content')
            ->add('keywords','textarea' , ['label' => 'SEO keywords( Optional )' , 'required' => false])
            ->add('description','textarea' , ['label' => 'SEO Description( Optional )' , 'required' => false])
            ->add('meta','textarea',['label' => 'SEO Meta( Optional )' , 'required'=>false])
            ->add('title' , 'textarea' , ['label'=>'SEO Page Title( Optional )'  , 'required' => false])
            ->add('publish')
            ->add('category')
        ;

        $builder->add('save' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Web\BackBundle\Entity\Newsfeed'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'web_backbundle_newsfeed';
    }
}
