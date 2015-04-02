<?php

namespace HB\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', 
                    array(
                        'attr'=> 
                             array(
                                 'placeholder'=>'NOM Prénom de l\'utilisateur',
                                 'class'=>'form-control'),
                        'label'=>'NOM Prénom'))
            ->add('email', 'repeated', 
                    array(
                        'type'=>'email',
                        'invalid_message'=>'Les adresses email doivent correspondre',
                        'first_options'=>array('label'=>'Email', 
                            'attr'=> 
                             array(
                                 'placeholder'=>'Email de l\'utilisateur',
                                 'class'=>'form-control'),),
                        'second_options'=>array('label'=>'Email (confirmer)',
                            'attr'=> 
                             array(
                                 'placeholder'=>'Email de l\'utilisateur',
                                 'class'=>'form-control'))))
            ->add('login', 'text',
                    array(
                        'attr'=> 
                             array(
                                 'placeholder'=>'Login de connexion',
                                 'class'=>'form-control'),
                        'label'=>'Login de connexion'))
            ->add('password', 'repeated', array(
                'type'=>'password', 
                'invalid_message'=>'Les mot de passe doivent correspondre',
                'first_options'=>array('label'=>'Mot de passe','attr'=> 
                            array(
                                'class'=>'form-control')),
                'second_options'=>array('label'=>'Mot de passe (confirmer)','attr'=> 
                            array(
                                'class'=>'form-control'))))
            ->add('birthDate', 'birthday',
                    array(
                        'label'=>'Date de naissance')) // Permet de définir une date entre l'année en cours et 1902
            ->add('creationDate', 'datetime', array('years'=>range(date('Y')-20,date('Y')))) // Permet de definir des limites ici entre l'année en cours et 20 ans avants
            ->add('lastEditDate', 'datetime', array('disabled'=>true))
            ->add('enabled', 'checkbox', array('required'=>false, 'label'=>'Activer le compte', 'label_attr'=> 
                            array(
                                'class'=>'checkbox-inline')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\BlogBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_user';
    }
}
