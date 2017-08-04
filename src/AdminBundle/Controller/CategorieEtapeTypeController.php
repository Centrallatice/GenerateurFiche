<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\CategorieEtapeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Logs;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Categorieetapetype controller.
 *
 * @Route("categorieetapetype")
 */
class CategorieEtapeTypeController extends Controller
{
    /**
     * Lists all categorieEtapeType entities.
     *
     * @Route("/", name="categorieetapetype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieEtapeTypes = $em->getRepository('AdminBundle:CategorieEtapeType')->findAll();

        return $this->render('AdminBundle:categorieetapetype:index.html.twig', array(
            'categorieEtapeTypes' => $categorieEtapeTypes,
        ));
    }

    /**
     * Creates a new categorieEtapeType entity.
     *
     * @Route("/new", name="categorieetapetype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieEtapeType = new Categorieetapetype();
        $user = $this->getUser();
        $categorieEtapeType->setAuteur($user->getFirstname()." ".$user->getLastname());
        
        $form = $this->createForm('AdminBundle\Form\CategorieEtapeTypeType', $categorieEtapeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieEtapeType");
            $L->setTypeAction("Creation");
            $L->setIdEntityText($categorieEtapeType->getNom());
            
            $em->persist($L);
            $em->persist($categorieEtapeType);
            $em->flush();

            return $this->redirectToRoute('categorieetapetype_index');
        }

        return $this->render('AdminBundle:categorieetapetype:new.html.twig', array(
            'categorieEtapeType' => $categorieEtapeType,
            'form' => $form->createView(),
        ));
    }

    

    /**
     * Displays a form to edit an existing categorieEtapeType entity.
     *
     * @Route("/{id}/edit", name="categorieetapetype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieEtapeType $categorieEtapeType)
    {
        $editForm = $this->createForm('AdminBundle\Form\CategorieEtapeTypeType', $categorieEtapeType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $L = new Logs();
            $user = $this->getUser();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieEtapeType");
            $L->setTypeAction("Creation");
            $L->setIdEntityText($categorieEtapeType->getNom());
            $this->getDoctrine()->getManager()->persist($L);
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('categorieetapetype_edit', array('id' => $categorieEtapeType->getId()));
        }

        return $this->render('AdminBundle:categorieetapetype:edit.html.twig', array(
            'categorieEtapeType' => $categorieEtapeType,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a categorieDenree entity.
     *
     * @Route("/delete/{id}", name="categorieetapetype_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $CategorieEtapeType = $em->getRepository(CategorieEtapeType::class)->find($id);
        if($CategorieEtapeType!==null):
            $user = $this->getUser();
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieEtapeType");
            $L->setTypeAction("Suppression");
            $L->setIdEntity($CategorieEtapeType->getId());
            $L->setIdEntityText($CategorieEtapeType->getNom());
            $this->getDoctrine()->getManager()->persist($L);
            $em->remove($CategorieEtapeType);
            $em->flush();
            return new JsonResponse(array("success"=>true));
        else:
            return new JsonResponse(array("success"=>true));            
        endif;
    }
}
