<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AdminBundle\Form\UniteMesureLangType;
class UniteMesureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
                ->add('estReference',ChoiceType::class,array(
                    "label"=>"Est la valeur de référence ? (Attention une seule unité par groupe et par langue peut-être unité de réfèrence - mg pour les masses fr par exemples)",
                    "multiple"=>false,
                    "expanded"=>true,
                    "choices"=>array(
                        "Oui"=>true,
                        "Non"=>false
                    )
                ))
                ->add('uniteMesureLang',CollectionType::class,array(
                    'label' => false,
                    'entry_type' => UniteMesureLangType::class,
                    'allow_add' => false
                ))
                ->add('groupe', ChoiceType::class,array(
                    "label"=>"Groupe de mesure",
                    "choices"=>array(
                        "Unité de Masse"=>"masse",
                        "Unité de Volume"=>"volume"
                    )
                ))
                ->add('valeurReference',IntegerType::class,array("label"=>"Valeur de référence"))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\UniteMesure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_unitemesure';
    }


}
