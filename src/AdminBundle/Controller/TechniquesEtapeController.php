<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\TechniquesEtape;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AdminBundle\Entity\EtapeProduit;
use AdminBundle\Entity\Produit;
use AdminBundle\Form\TechniquesEtapeType;
use AdminBundle\Entity\Logs;

/**
 * Techniquesetape controller.
 *
 * @Route("technique")
 */
class TechniquesEtapeController extends Controller
{
    /**
     * Lists all techniquesEtape entities.
     *
     * @Route("/", name="technique_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $techniquesEtapes = $em->getRepository('AdminBundle:TechniquesEtape')->findAll();

        return $this->render('AdminBundle:techniquesetape:index.html.twig', array(
            'techniquesEtapes' => $techniquesEtapes,
        ));
    }

    /**
     * Creates a new techniquesEtape entity.
     *
     * @Route("/new", name="technique_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $techniquesEtape = new Techniquesetape();
        
        $user = $this->getUser();
        $techniquesEtape->setAuteur($user->getFirstname()." ".$user->getLastname());
        $form = $this->createForm(TechniquesEtapeType::class, $techniquesEtape);
        
        return new JsonResponse($this->renderView('AdminBundle:techniquesetape:new.html.twig', array(
            'techniquesEtape' => $techniquesEtape,
            'form' => $form->createView(),
        )));
    }

    /**
     * Creates a new techniquesEtape entity.
     *
     * @Route("/valide_new", name="technique_valide_new")
     */
    public function newAjaxAction(Request $request)
    {
        try{
            
            $Techniquesetape = new Techniquesetape();
            $em = $this->getDoctrine()->getManager();
            $data = $request->request->all();
            
            
            $user = $this->getUser();
            $uName = $this->getParameter($user->getUsername());
            $Techniquesetape->setAuteur($uName['name']);
            
            $Techniquesetape->setTitre($data['t']);
            $Techniquesetape->setDescription($data['d']);
            $Techniquesetape->setLienExterne($data['l']);
            
            $E = $em->getRepository(EtapeProduit::class)->find($data['idEtape']);
            if($E==null):
                return new JsonResponse(array("success"=>false,"message"=>"Etape de référence introuvrable"));
            endif;
            $Techniquesetape->setEtapes($E);
            $em->persist($Techniquesetape);
            $em->flush();
            return new JsonResponse(array("success"=>true,"message"=>null));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }
    
    /**
     * Finds and displays a techniquesEtape entity.
     *
     * @Route("/{id}", name="technique_show")
     * @Method("GET")
     */
    public function showAction(TechniquesEtape $techniquesEtape)
    {
        $deleteForm = $this->createDeleteForm($techniquesEtape);

        return $this->render('AdminBundle:techniquesetape:show.html.twig', array(
            'techniquesEtape' => $techniquesEtape,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing techniquesEtape entity.
     *
     * @Route("/{id}/edit", name="technique_edit")
     * @Method({"GET", "POST"})
     */
   public function editAction(Request $request, TechniquesEtape $techniquesEtape)
    {
        $editForm = $this->createForm(TechniquesEtapeType::class, $techniquesEtape,array("attr"=>array("id"=>"formValideEditTechnique"),"action"=>$this->generateUrl('technique_valid_edit', ['id'=>$techniquesEtape->getId()])));
        
        $editForm->handleRequest($request);
        return new JsonResponse($this->renderView('AdminBundle:techniquesetape:edit.html.twig', array(
            'techniquesEtape' => $techniquesEtape,
            'edit_form' => $editForm->createView(),
        )));
    }
    
    /**
     * Displays a form to edit an existing techniquesEtape entity.
     *
     * @Route("/{id}/valid_edit", name="technique_valid_edit")
     * @Method({"GET", "POST"})
     */
    public function editValideAction(Request $request,$id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $dataForms = $request->request->all();
            $Techniquesetape = $em->getRepository(TechniquesEtape::class)->find($id);
            if($Techniquesetape === null):
                return new JsonResponse(array("success"=>false,"message"=>"Une erreur est survenue (Technique introuvable)"));
            else:
                $Techniquesetape->setTitre($dataForms['adminbundle_techniquesetape']['titre']);
                $Techniquesetape->setDescription($dataForms['adminbundle_techniquesetape']['description']);
                $Techniquesetape->setLienExterne($dataForms['adminbundle_techniquesetape']['lienExterne']);
                $em->persist($Techniquesetape);
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
     * Deletes a techniquesEtape entity.
     *
     * @Route("/{id}", name="technique_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $dataForms = $request->request->all();
            $TechniquesEtape = $em->getRepository(TechniquesEtape::class)->find($id);
            if($TechniquesEtape === null):
                return new JsonResponse(array("success"=>false,"message"=>"Une erreur est survenue (Technique introuvable)"));
            else:
                $em->remove($TechniquesEtape);
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
     * Creates a form to delete a techniquesEtape entity.
     *
     * @param TechniquesEtape $techniquesEtape The techniquesEtape entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TechniquesEtape $techniquesEtape)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('technique_delete', array('id' => $techniquesEtape->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
