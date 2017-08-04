<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AdminBundle\Entity\Lang;

class UniteMesureLangType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom',TextType::class,array("label"=>"Abbréviation"))
                ->add('description')
                ->add('equivalence',NumberType::class,array("scale"=>4,"attr"=>array("size"=>3)))
                ->add('lang',EntityType::class,array(
                    "label"=>"Langue",
                    "class"=>Lang::class,
                    "choice_label" => 'nom',
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\UniteMesureLang'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_unitemesurelang';
    }


}
