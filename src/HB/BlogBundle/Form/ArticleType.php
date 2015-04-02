<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', 
                    array(
                        'attr'=> 
                             array(
                                 'placeholder'=>'Donnez un titre à votre article',
                                 'class'=>'form-control'),
                        'label'=>'Titre de l\'article'))
            ->add('content', 'text', 
                    array(
                        'attr'=> 
                             array(
                                 'placeholder'=>'Veuillez indiquer ici le contenu de votre article',
                                 'class'=>'form-control'),
                        'label'=>'Contenu'))
            //->add('creationDate')
            //->add('lastEditDate')
            ->add('publishDate', 'datetime',array(
                        'attr'=> 
                             array(
                                 'class'=>'form-control'),
                        'label'=>'Date de publication'))
            ->add('published', 'checkbox', array('required' => false))
            ->add('enabled', 'checkbox', array('required'=>false, 'label'=>'Activer l\'article', 'label_attr'=> 
                            array(
                                'class'=>'checkbox-inline')))
            ->add('author', 'entity', array('class' => 'HBBlogBundle:User',
                                            'property' => 'nameLogin',
                                            'attr'=> 
                                                array(
                                                    'class'=>'form-control'),
                                           'label'=>'Auteur'))
            ->add('banner', new ImageType)
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_article';
    }
    
            /**
     * 
     */
    
}
