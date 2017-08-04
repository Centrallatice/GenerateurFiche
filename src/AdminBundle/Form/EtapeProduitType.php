<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapeProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('titre')
                ->add('codeCouleur')
                ->add('dureeType',ChoiceType::class,array(
                    "label"=>"Méthode de calcul de la durée de fabrication",
                    "choices"=>array(
                        "Indivisible selon la quantité (Temps)"=>"indivisible",
                        "Unitaire selon la quantité (Qtt * Temps unitaire)"=>"unitaire"
                    )
                ))
                ->add('dureeUnite',ChoiceType::class,array(
                    "label"=>"Unité de durée",
                    "choices"=>array(
                        "Seconde(s)"=>"s",
                        "Minute(s)"=>"m",
                        "Heure(s)"=>"h",
                    )
                ))
                ->add('dureeValeur',TextType::class,array("label"=>"Durée (selon l'unité sélectionnée)"))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\EtapeProduit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_etapeproduit';
    }


}
