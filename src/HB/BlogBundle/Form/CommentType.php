<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', 'text')
            ->add('creationDate', 'datetime')
            ->add('lastEditDate', 'datetime')
            ->add('adminValidation', 'checkbox', array('required' => false))
            ->add('validationDate', 'datetime')
            ->add('authorName', 'text')
            ->add('author', 'entity', array('class' => 'HBBlogBundle:User',
                                            'property' => 'nameLogin'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_comment';
    }
}
