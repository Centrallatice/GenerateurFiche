<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\EtapeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AdminBundle\Entity\Produit;
use AdminBundle\Entity\EtapeDenree;
use AdminBundle\Entity\Logs;
use AdminBundle\Entity\CategorieEtapeType;
use AdminBundle\Entity\EtapeType;

/**
 * Etapeproduit controller.
 *
 * @Route("etape")
 */
class EtapeProduitController extends Controller
{
    /**
     * Lists all etapeProduit entities.
     *
     * @Route("/", name="etape_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etapeProduits = $em->getRepository('AdminBundle:EtapeProduit')->findAll();

        return $this->render('AdminBundle:etapeproduit:index.html.twig', array(
            'etapeProduits' => $etapeProduits,
        ));
    }

    /**
     * Creates a new etapeProduit entity.
     *
     * @Route("/new", name="etape_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $etapeProduit = new Etapeproduit();
        $user = $this->getUser();
        $etapeProduit->setAuteur($user->getFirstname()." ".$user->getLastname());
        $form = $this->createForm('AdminBundle\Form\EtapeProduitType', $etapeProduit);
        
        $em = $this->getDoctrine()->getManager();
           
            
        $categorieEtapeTypes = $em->getRepository(CategorieEtapeType::class)->findAll();
        if(count($categorieEtapeTypes)>0):
            $etapesTypes = $em->getRepository(EtapeType::class)->findBy(array(
                "categorieEtapeType"=>reset($categorieEtapeTypes)
            )); 
        else:
            $etapesTypes=array();
        endif;
        
        return new JsonResponse($this->renderView('AdminBundle:etapeproduit:new.html.twig', array(
            'etapeProduit' => $etapeProduit,
            'categorieEtapeTypes' => $categorieEtapeTypes,
            'etapesTypes' => $etapesTypes,
            'form' => $form->createView(),
        )));
    }
    /**
     * add a new denree to the step.
     *
     * @Route("/add_denree", name="etape_add_denree")
     * @Method({"GET", "POST"})
     */
    public function addDenreeAction(Request $request)
    {
        $data = $request->request->all();
        $form = $this->createForm('AdminBundle\Form\EtapeDenreeType',null,array(
            "idProduit"=>$data['idP'],
            "attr"=>array(
                "id"=>"formValideEditAddDenree"
            ),
            "action"=>$this->generateUrl('etape_add_denree_valide')
        ));
        return new JsonResponse($this->renderView('AdminBundle:etapeproduit:addDenree.html.twig', array(
            'form' => $form->createView(),
        )));
    }
    /**
     * remove a new denree from the step.
     *
     * @Route("/remove_denree", name="etape_remove_denree")
     * @Method({"GET", "POST"})
     */
    public function removeDenreeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $d=$request->request->all();
        $EtapeDenree= $em->getRepository(EtapeDenree::class)->find($d['id']);
        if($EtapeDenree!==null):
             $em->remove($EtapeDenree);
            $em->flush();
             return new JsonResponse(array("success"=>true));
        else:
             return new JsonResponse(array("success"=>false));
            
        endif;    
       
    }
    
    /**
     * add a new denree to the step.
     *
     * @Route("/add_denree_valide", name="etape_add_denree_valide")
     * @Method({"GET", "POST"})
     */
    public function addDenreeValideAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $dataForms = $request->request->all();
            $EtapeProduit = $em->getRepository(EtapeProduit::class)->find($dataForms['adminbundle_etape_denree']['etapeProduit']);
            $Denree = $em->getRepository(\AdminBundle\Entity\Denree::class)->find($dataForms['adminbundle_etape_denree']['denreeProduit']);
            if($EtapeProduit === null || $Denree===null):
                return new JsonResponse(array("success"=>false,"message"=>"Une erreur est survenue (Etape ou denrée introuvable)"));
            else:
                $EtapeDenree = new EtapeDenree();
                $EtapeDenree->setDenree($Denree);
                $EtapeDenree->setEtape($EtapeProduit);
                $EtapeDenree->setQuantite($dataForms['adminbundle_etape_denree']['quantite']);
                $em->persist($EtapeDenree);
                $em->flush();
                
                $EtapeProduit->addEtapeDenree($EtapeDenree);
                $Denree->addEtapeDenree($EtapeDenree);
                $em->persist($EtapeProduit);
                $em->persist($Denree);
                $em->flush();
                return new JsonResponse(array("success"=>true,"message"=>null));
            endif;
        
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
        
    }
    /**
     * Creates a new etapeProduit entity.
     *
     * @Route("/valide_new", name="etape_valide_new")
     */
    public function newAjaxAction(Request $request)
    {
        try{
            
            $etapeProduit = new Etapeproduit();
            $em = $this->getDoctrine()->getManager();
            $data = $request->request->all();
            
            $produits = $em->getRepository(EtapeProduit::class)->findBy(array("produit"=>$data['idP']));
            
            $user = $this->getUser();
            $uName = $this->getParameter($user->getUsername());
            $etapeProduit->setAuteur($uName['name']);
            
            $etapeProduit->setTitre($data['t']);
            $etapeProduit->setCodeCouleur($data['c']);
            $etapeProduit->setOrdre(count($produits)+1);
            
            $etapeProduit->setDureeType($data['dT']);
            $etapeProduit->setDureeValeur($data['dV']);
            $etapeProduit->setDureeUnite($data['dU']);
            
            $P = $em->getRepository(Produit::class)->find($data['idP']);
            if($P==null):
                return new JsonResponse(array("success"=>false,"message"=>"Produit de référence introuvrable"));
            endif;
            $etapeProduit->setProduit($P);
            $em->persist($etapeProduit);
            $em->flush();
            return new JsonResponse(array("success"=>true,"message"=>null));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }
    
    /**
     * reordonner les etapes
     *
     * @Route("/reorder", name="etape_reorder")
     */
    public function reorderAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $data = $request->request->all();
            $Etape = $em->getRepository(EtapeProduit::class)->find($data['id']);
            if($Etape==null):
                return new JsonResponse(array("success"=>false,"message"=>"Etape de référence introuvrable"));
            else:
                if($data['sens']==1):
                    $PrevEtape = $em->getRepository(EtapeProduit::class)->findOneBy(array("ordre"=>($Etape->getOrdre()-1)));
                    if($PrevEtape==null):
                        return new JsonResponse(array("success"=>false,"message"=>"Etape précèdente introuvrable"));
                    else:
                        $Etape->setOrdre(($Etape->getOrdre()-1));
                        $PrevEtape->setOrdre(($PrevEtape->getOrdre()+1));
                        $em->persist($PrevEtape);
                    endif;
                else:
                    $NextEtape = $em->getRepository(EtapeProduit::class)->findOneBy(array("ordre"=>($Etape->getOrdre()+1)));
                    if($NextEtape==null):
                        return new JsonResponse(array("success"=>false,"message"=>"Etape suivante introuvrable"));
                    else:
                        $Etape->setOrdre(($Etape->getOrdre()+1));
                        $NextEtape->setOrdre(($NextEtape->getOrdre()-1));
                        $em->persist($NextEtape);
                    endif;
                endif;
            endif;
            
            $em->persist($Etape);
            $em->flush();
            return new JsonResponse(array("success"=>true,"message"=>null));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }

    /**
     * Finds and displays a etapeProduit entity.
     *
     * @Route("/{id}", name="etape_show")
     * @Method("GET")
     */
    public function showAction(EtapeProduit $etapeProduit)
    {
        $deleteForm = $this->createDeleteForm($etapeProduit);

        return $this->render('AdminBundle:etapeproduit:show.html.twig', array(
            'etapeProduit' => $etapeProduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing etapeProduit entity.
     *
     * @Route("/{id}/edit", name="etape_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EtapeProduit $etapeProduit)
    {
        $editForm = $this->createForm('AdminBundle\Form\EtapeProduitType', $etapeProduit,array("attr"=>array("id"=>"formValideEditEtape"),"action"=>$this->generateUrl('etape_valid_edit', ['id'=>$etapeProduit->getId()])));
        
        $editForm->handleRequest($request);
        return new JsonResponse($this->renderView('AdminBundle:etapeproduit:edit.html.twig', array(
            'etapeProduit' => $etapeProduit,
            'edit_form' => $editForm->createView(),
        )));
    }
    
    
    /**
     * Displays a form to edit an existing etapeProduit entity.
     *
     * @Route("/{id}/valid_edit", name="etape_valid_edit")
     * @Method({"GET", "POST"})
     */
    public function editValideAction(Request $request,$id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $dataForms = $request->request->all();
            $EtapeProduit = $em->getRepository(EtapeProduit::class)->find($id);
            if($EtapeProduit === null):
                return new JsonResponse(array("success"=>false,"message"=>"Une erreur est survenue (Etape introuvable)"));
            else:
                $EtapeProduit->setTitre($dataForms['adminbundle_etapeproduit']['titre']);
                $EtapeProduit->setCodeCouleur($dataForms['adminbundle_etapeproduit']['codeCouleur']);
                $EtapeProduit->setDureeType($dataForms['adminbundle_etapeproduit']['dureeType']);
                $EtapeProduit->setDureeValeur($dataForms['adminbundle_etapeproduit']['dureeValeur']);
                $EtapeProduit->setDureeUnite($dataForms['adminbundle_etapeproduit']['dureeUnite']);
                $em->persist($EtapeProduit);
                $em->flush();
                return new JsonResponse(array("success"=>true,"message"=>null));
            endif;
        
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }

    /**
     * Deletes a etapeProduit entity.
     *
     * @Route("/{id}", name="etape_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $dataForms = $request->request->all();
            $EtapeProduit = $em->getRepository(EtapeProduit::class)->find($id);
            if($EtapeProduit === null):
                return new JsonResponse(array("success"=>false,"message"=>"Une erreur est survenue (Etape introuvable)"));
            else:
                $em->remove($EtapeProduit);
                $em->flush();
                return new JsonResponse(array("success"=>true,"message"=>null));
            endif;
        
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }

    /**
     * Creates a form to delete a etapeProduit entity.
     *
     * @param EtapeProduit $etapeProduit The etapeProduit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EtapeProduit $etapeProduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etape_delete', array('id' => $etapeProduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
