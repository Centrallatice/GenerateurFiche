<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use AdminBundle\Entity\EtapeProduit;
use AdminBundle\Entity\Denree;
use Doctrine\ORM\EntityRepository;
/**
 * Description of EtapeDenreeType
 *
 * @author Sylvain
 */
class EtapeDenreeType extends AbstractType{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
                ->add('etapeProduit',EntityType::class,array(
                    'label'=>'Etape',
                    "class"=>EtapeProduit::class,
                    'query_builder' => function (EntityRepository $er) use ($options){
                        return $er->createQueryBuilder('e')->where('e.produit='.$options['idProduit'])
                            ->orderBy('e.titre', 'ASC');
                    },
                    "choice_label" => 'titre',
                    "choice_value" => 'id'
                ))
                ->add('denreeProduit',EntityType::class,array(
                    'label'=>'Denrée',
                    "class"=>Denree::class,
                    "choice_label" => 'nom',
                    "choice_value" => 'id',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('d')
                            ->orderBy('d.nom', 'ASC');
                    },
                    'group_by' => function($val, $key, $index) {
                        return $val->getCategorieDenree()->getNom();
                    },
                ))
                ->add('quantite',NumberType::class,array("scale"=>2,"label"=>"Quantité nécessaire"));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'idProduit' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_etape_denree';
    }
}
