<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AdminBundle\Entity\CategorieProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AdminBundle\Entity\Lang;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;

class ProduitLangType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('description',FroalaEditorType::class)
                ->add('descriptionApport',FroalaEditorType::class,array("label"=>"Texte descriptif de l'apport nutritionnel"))
                ->add('dressageType',TextType::class,array("label"=>"Dressage"))
                ->add('lang',EntityType::class,array(
                    "label"=>"Langue",
                    "class"=>Lang::class,
                    "choice_label" => 'description',
                ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\ProduitLang'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_produitlang';
    }


}
