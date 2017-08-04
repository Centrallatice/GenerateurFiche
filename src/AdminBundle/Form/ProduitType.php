<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AdminBundle\Entity\CategorieProduit;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
//use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;


class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
                ->add('description',FroalaEditorType::class)
                ->add('descriptionApport',FroalaEditorType::class,array("label"=>"Texte descriptif de l'apport nutritionnel"))
                ->add('apportNutritionnelUnitaire',IntegerType::class,array("scale"=>2,"label"=>"Valeur en KJ de l'apport nutritionnel"))
//                ->add('coutHT',NumberType::class,array("scale"=>2,"label"=>"Coût HT"))
                ->add('coefficient',IntegerType::class,array("scale"=>2,"label"=>"Coefficient par défaut"))
//                ->add('pVUHT',NumberType::class,array("scale"=>2,"label"=>"Prix de vente par portion HT"))
                ->add('dressageType',TextType::class,array("label"=>"Dressage"))
                ->add('imageName',FileType::class,array("label"=>"Image du produit","required"=>false))
                ->add('categorieProduit',EntityType::class,array(
                    "label"=>"Type de plat",
                    "class"=>CategorieProduit::class,
                    "choice_label" => 'nom',
                    "required"=>false
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_produit';
    }


}
