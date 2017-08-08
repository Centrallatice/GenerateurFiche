<?php

namespace AdminBundle\Form;
use AdminBundle\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,array("label"=>"Adresse email"))
            ->add('username', TextType::class,array("label"=>"Login"))
            ->add('firstname', TextType::class,array("label"=>"Prénom"))
            ->add('lastname', TextType::class,array("label"=>"Nom"))
            ->add('roles', ChoiceType::class,array(
                "label"=>"Role",
                "choices"=>array(
                    "ROLE_ADMINISTRATEUR"=>"ROLE_ADMINISTRATEUR",
                    "ROLE_CREATEUR"=>"ROLE_CREATEUR",
                    "ROLE_LECTEUR"=>"ROLE_LECTEUR"
                    ),
                'multiple' => true
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}