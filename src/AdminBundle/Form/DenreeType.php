<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AdminBundle\Entity\CategorieDenree;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AdminBundle\Entity\UniteMesure;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DenreeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('uniteMesure',EntityType::class,array(
                    'label'=>'Unité de mesure',
                    "class"=>UniteMesure::class,
                    "choice_label" => 'description',
                    "choice_value" => 'nom'
                ))
                ->add('pUHT',NumberType::class,array("scale"=>2,"label"=>"Prix Unitaire HT"))
                ->add('categorieDenree',EntityType::class,array(
                    "label"=>"Catégorie",
                    "class"=>CategorieDenree::class,
                    "choice_label" => 'nom',
                    "required"=>false
                ))->add('code');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Denree'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_denree';
    }


}
