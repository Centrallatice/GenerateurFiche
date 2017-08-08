<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\EtapeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\EtapeTypeLang;
use AdminBundle\Form\EtapeTypeType;
use AdminBundle\Entity\Logs;
use Symfony\Component\HttpFoundation\JsonResponse;
use AdminBundle\Entity\CategorieEtapeType;

/**
 * Etapetype controller.
 *
 * @Route("etapetype")
 */
class EtapeTypeController extends Controller
{
    /**
     * Lists all etapeType entities.
     *
     * @Route("/", name="etapetype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $etapeTypes = $em->getRepository('AdminBundle:EtapeType')->findAll();
        return $this->render('AdminBundle:etapetype:index.html.twig', array(
            'etapeTypes' => $etapeTypes,
        ));
    }

    /**
     * Creates a new etapeType entity.
     *
     * @Route("/new", name="etapetype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $etapeType = new EtapeType();
        $user = $this->getUser();
        $etapeType->setAuteur($user->getFirstname()." ".$user->getLastname());
        $Langues = $em->getRepository('AdminBundle:Lang')->findAll();
        foreach($Langues as $L):
            $etapeTypeLang = new EtapeTypeLang();
            $etapeTypeLang->setLang($L);
            $etapeType->addEtapesTypesLang($etapeTypeLang);
        endforeach;
        
        
        $form = $this->createForm(EtapeTypeType::class, $etapeType);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("EtapeType");
            $L->setTypeAction("Creation");
            $langues = $etapeType->getEtapesTypesLang();
            foreach($langues as $l):
                $l->setEtapesTypes($etapeType);
                if($l->getLang()->getNom()=="fr"):
                    $L->setIdEntityText($l->getTitre());
                endif;
            endforeach;
            
            $L->setIdEntity($etapeType->getId());
            $em->persist($L);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($etapeType);
            $em->flush();

            return $this->redirectToRoute('etapetype_index');
        }

        return $this->render('AdminBundle:etapetype:new.html.twig', array(
            'etapeType' => $etapeType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etapeType entity.
     *
     * @Route("/{id}", name="etapetype_show")
     * @Method("GET")
     */
    public function showAction(EtapeType $etapeType)
    {
        $deleteForm = $this->createDeleteForm($etapeType);

        return $this->render('AdminBundle:etapetype:show.html.twig', array(
            'etapeType' => $etapeType,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * @Route("/getByCat", name="etapetype_getByCat")
     */
    public function getByCatAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $datas = $request->request->all();

            $categorieEtapeType = $em->getRepository(CategorieEtapeType::class)->find($datas['id']); 
            $etapesTypes = $em->getRepository(EtapeType::class)->findBy(array(
                "categorieEtapeType"=>$categorieEtapeType
            )); 
            $etapes = array();
            foreach($etapesTypes as $et):
                array_push($etapes,array("id"=>$et->getId(),"titre"=>$et->getEtapesTypesLang()[0]->getTitre()));
            endforeach;
            return new JsonResponse(array("success"=>true,"data"=>$etapes));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }
    /**
     * @Route("/get", name="etapetype_get")
     */
    public function getAction(Request $request)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $datas = $request->request->all();
            $etape = $em->getRepository(EtapeType::class)->find($datas['id']); 
                    
            $arrayEtape = array();
            foreach($etape->getEtapesTypesLang() as $e):
                $arrayEtape[$e->getLang()->getId()]=array("titre"=>$e->getTitre(),"contenu"=>$e->getContenu());
            endforeach;
            return new JsonResponse(array("success"=>true,"data"=>$arrayEtape));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }

    /**
     * Displays a form to edit an existing etapeType entity.
     *
     * @Route("/{id}/edit", name="etapetype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EtapeType $etapeType)
    {
        $deleteForm = $this->createDeleteForm($etapeType);
        $editForm = $this->createForm('AdminBundle\Form\EtapeTypeType', $etapeType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etapetype_edit', array('id' => $etapeType->getId()));
        }

        return $this->render('AdminBundle:etapetype:edit.html.twig', array(
            'etapeType' => $etapeType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etapeType entity.
     *
     * @Route("/{id}", name="etapetype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EtapeType $etapeType)
    {
        $form = $this->createDeleteForm($etapeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etapeType);
            $em->flush();
        }

        return $this->redirectToRoute('etapetype_index');
    }

    /**
     * Creates a form to delete a etapeType entity.
     *
     * @param EtapeType $etapeType The etapeType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EtapeType $etapeType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etapetype_delete', array('id' => $etapeType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
