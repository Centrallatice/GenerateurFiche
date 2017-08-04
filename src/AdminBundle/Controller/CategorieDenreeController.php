<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\CategorieDenree;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Entity\Logs;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Categoriedenree controller.
 *
 * @Route("categorie_denree")
 */
class CategorieDenreeController extends Controller
{
    /**
     * Lists all categorieDenree entities.
     *
     * @Route("/", name="categorie_denree_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorieDenrees = $em->getRepository('AdminBundle:CategorieDenree')->findAll();
        return $this->render('AdminBundle:categoriedenree:index.html.twig', array(
            'categorieDenrees' => $categorieDenrees,
        ));
    }

    /**
     * Creates a new categorieDenree entity.
     *
     * @Route("/new", name="categorie_denree_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieDenree = new Categoriedenree();
        $user = $this->getUser();
        $categorieDenree->setAuteur($user->getFirstname()." ".$user->getLastname());
        $form = $this->createForm('AdminBundle\Form\CategorieDenreeType', $categorieDenree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieDenree");
            $L->setTypeAction("Creation");
            $L->setIdEntityText($categorieDenree->getNom());
            $em->persist($categorieDenree);
            $em->flush();
            $L->setIdEntity($categorieDenree->getId());
            $em->persist($L);
            $em->flush();
            return $this->redirectToRoute('categorie_denree_index');
        }

        return $this->render('AdminBundle:categoriedenree:new.html.twig', array(
            'categorieDenree' => $categorieDenree,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieDenree entity.
     *
     * @Route("/{id}", name="categorie_denree_show")
     * @Method("GET")
     */
    public function showAction(CategorieDenree $categorieDenree)
    {
        $deleteForm = $this->createDeleteForm($categorieDenree);

        return $this->render('AdminBundle:categoriedenree:show.html.twig', array(
            'categorieDenree' => $categorieDenree,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieDenree entity.
     *
     * @Route("/{id}/edit", name="categorie_denree_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieDenree $categorieDenree)
    {
//        $deleteForm = $this->createDeleteForm($categorieDenree);
        $editForm = $this->createForm('AdminBundle\Form\CategorieDenreeType', $categorieDenree);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $user = $this->getUser();
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieDenree");
            $L->setTypeAction("Modification");
            $L->setIdEntity($categorieDenree->getId());
            $L->setIdEntityText($categorieDenree->getNom());
            $this->getDoctrine()->getManager()->persist($L);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('categorie_denree_edit', array('id' => $categorieDenree->getId()));
        }

        return $this->render('AdminBundle:categoriedenree:edit.html.twig', array(
            'categorieDenree' => $categorieDenree,
            'edit_form' => $editForm->createView()
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieDenree entity.
     *
     * @Route("/delete/{id}", name="categorie_denree_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorieDenree = $em->getRepository('AdminBundle:CategorieDenree')->find($id);
        if($categorieDenree!==null):
            $user = $this->getUser();
            $L = new Logs();
            $L->setAuteur($user->getFirstname()." ".$user->getLastname());
            $L->setEntity("CategorieDenree");
            $L->setTypeAction("Suppression");
            $L->setIdEntity($categorieDenree->getId());
            $L->setIdEntityText($categorieDenree->getNom());
            $this->getDoctrine()->getManager()->persist($L);
            $denrees = $categorieDenree->getDenrees();
            foreach($denrees as $d):
                $d->setCategorieDenree(null);
                $em->persist($d);
                $em->flush();
            endforeach;
            $em->remove($categorieDenree);
            $em->flush();
            return new JsonResponse(array("success"=>true));
        else:
            return new JsonResponse(array("success"=>true));            
        endif;
    }

}
