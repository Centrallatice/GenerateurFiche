<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AdminBundle\Form\EtapeTypeLangType;
use AdminBundle\Entity\CategorieEtapeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EtapeTypeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('categorieEtapeType',EntityType::class,array(
                    "label"=>"Catégorie parente",
                    "class"=>CategorieEtapeType::class,
                    "choice_label" => 'nom',
                    "required"=>true
                ))
                ->add('EtapeTypeLang',CollectionType::class,array(
                    'label' => false,
                    'entry_type' => EtapeTypeLangType::class,
                    'allow_add' => false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\EtapeType'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_etapetype';
    }


}
