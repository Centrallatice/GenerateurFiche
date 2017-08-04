<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\UniteMesure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Logs;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Unitemesure controller.
 *
 * @Route("unitemesure")
 */
class UniteMesureController extends Controller
{
    /**
     * Lists all uniteMesure entities.
     *
     * @Route("/", name="unitemesure_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $uniteMesures = $em->getRepository('AdminBundle:UniteMesure')->findBy(array(),array("groupe"=>"ASC","valeurReference"=>"ASC"));
        $ref=array();
        foreach($uniteMesures as $um):
            if($um->getEstReference()):
                $ref[$um->getGroupe()]=$um->getUniteMesureLang()[0]->getNom();
            endif;
        endforeach;
        return $this->render('AdminBundle:unitemesure:index.html.twig', array(
            'uniteMesures' => $uniteMesures,
            'ref' => $ref
        ));
    }

    /**
     * Creates a new uniteMesure entity.
     *
     * @Route("/new", name="unitemesure_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $uniteMesure = new Unitemesure();
        $user = $this->getUser();
        $uniteMesure->setAuteur($user->getFirstname()." ".$user->getLastname());
        $Langues = $em->getRepository('AdminBundle:Lang')->findAll();
        foreach($Langues as $L):
            $uniteMesureLang = new \AdminBundle\Entity\UniteMesureLang();
            $uniteMesureLang->setLang($L);
            $uniteMesure->addUniteMesureLang($uniteMesureLang);
        endforeach;
        
        $form = $this->createForm('AdminBundle\Form\UniteMesureType', $uniteMesure);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            if($uniteMesure->getEstReference()):
                $ums = $em->getRepository('AdminBundle:UniteMesure')->findBy(array("estReference"=>"1","groupe"=>$uniteMesure->getGroupe()));
                if($ums!==null):
                    foreach($ums as $um):
                        $um->setEstReference(false);
                        $em->persist($um);
                        $em->flush();
                    endforeach;
                endif;
                $uniteMesure->setEstReference(true);
            endif;
            
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("UniteMesure");
            $L->setTypeAction("Creation");
            $langues = $uniteMesure->getUniteMesureLang();
            foreach($langues as $l):
                $l->setUniteMesure($uniteMesure);
                if($l->getLang()->getNom()=="fr"):
                    $L->setIdEntityText($l->getNom());
                endif;
            endforeach;
            
            $L->setIdEntity($uniteMesure->getId());
            $em->persist($L);
            $em->flush();
            return $this->redirectToRoute('unitemesure_index');
        }

        return $this->render('AdminBundle:unitemesure:new.html.twig', array(
            'uniteMesure' => $uniteMesure,
            'langues' => $Langues,
            'form' => $form->createView(),
        ));
    }

   

    /**
     * Displays a form to edit an existing uniteMesure entity.
     *
     * @Route("/{id}/edit", name="unitemesure_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UniteMesure $uniteMesure)
    {
        $editForm = $this->createForm('AdminBundle\Form\UniteMesureType', $uniteMesure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($uniteMesure->getEstReference()):
                $ums = $em->getRepository('AdminBundle:UniteMesure')->findBy(array("estReference"=>"1","groupe"=>$uniteMesure->getGroupe()));
                if($ums!==null):
                    foreach($ums as $um):
                        $um->setEstReference(false);
                        $em->persist($um);
                        $em->flush();
                    endforeach;
                endif;
                $uniteMesure->setEstReference(true);
            endif;
            $user = $this->getUser();
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("UniteMesure");
            $L->setTypeAction("Modification");
            $langues = $uniteMesure->getUniteMesureLang();
            foreach($langues as $l):
                if($l->getLang()->getNom()=="fr"):
                    $L->setIdEntityText($l->getNom());
                endif;
            endforeach;
            $L->setIdEntity($uniteMesure->getId());
            $em->persist($L);
            $em->flush();
            return $this->redirectToRoute('unitemesure_index');
        }

        return $this->render('AdminBundle:unitemesure:edit.html.twig', array(
            'uniteMesure' => $uniteMesure,
            'form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a uniteMesure entity.
     *
     * @Route("/delete/{id}", name="unitemesure_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        try{
            
            $em = $this->getDoctrine()->getManager();
            $uniteMesure = $em->getRepository(UniteMesure::class)->find($id);
            if($uniteMesure!==null):
                $n = $uniteMesure->getNom();
                $user = $this->getUser();
                $L = new Logs();
                $L->setAuteur($user->getFirstname()." ".$user->getLastname());
                $L->setEntity("UniteMesure");
                $L->setTypeAction("Suppression");
                $L->setIdEntity($id);
                $L->setIdEntityText($n);
                $this->getDoctrine()->getManager()->persist($L);
                $denrees = $uniteMesure->getDenrees();
                foreach($denrees as $d):
                    $d->setUniteMesure(null);
                    $em->persist($d);
                    $em->flush();
                endforeach;
                $em->remove($uniteMesure);
                $em->flush();
            endif;
            return new JsonResponse(array("success"=>true));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }
    
    /**
     * get uniteMesure by Lang and Group.
     *
     * @Route("/getByLangGroup", name="unitemesure_getbylang")
     */
    public function getByLangAction(Request $request)
    {
        try{            
            $datas = $request->request->all();
            $em = $this->getDoctrine()->getManager();
            $uniteMesures = $em->getRepository(UniteMesure::class)->findBy(array(
                "langue"=>$datas['l'],
                "groupe"=>$datas['g']
            ));
            $arrayMesures=array();
            foreach($uniteMesures as $arm):
                array_push($arrayMesures,array("id"=>$arm->getId(),"nom"=>$arm->getNom()." - ".$arm->getDescription()));
            endforeach;
            return new JsonResponse(array("datas"=>$arrayMesures));
        } catch(\Doctrine\ORM\ORMException $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        } catch(\Exception $e){
            return new JsonResponse(array("success"=>false,"message"=>$e->getMessage()));
        }
    }

    /**
     * Creates a form to delete a uniteMesure entity.
     *
     * @param UniteMesure $uniteMesure The uniteMesure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UniteMesure $uniteMesure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unitemesure_delete', array('id' => $uniteMesure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
