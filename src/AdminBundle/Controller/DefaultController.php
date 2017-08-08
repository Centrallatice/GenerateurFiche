<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Produit;
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
//        $categorieProduits = $em->getRepository(CategorieProduit::class)->findBy(array(),array("nom"=>"ASC"));
//        if($idCat!==null):
//            $cat = $em->getRepository(CategorieProduit::class)->find($idCat);
//            $produits = $em->getRepository(Produit::class)->findBy(array("categorieProduit"=>$cat));
//        else:
            $produits = $em->getRepository(Produit::class)->findAll();
//        endif;

        return $this->render('AdminBundle:Default:index.html.twig',array(
            "fiches"=>$produits,
            "locale"=>'fr'
        ));
        
//        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
