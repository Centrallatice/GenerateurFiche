<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AdminBundle\Controller;

use AdminBundle\Form\UserType;
use AdminBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AdminBundle\Entity\Logs;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegistrationController extends Controller
{
     /**
     * @Route("/show/{id}", name="user_show")
     */
    public function showAction(User $user)
    {
        
        return $this->render('AdminBundle:user:show.html.twig', array(
            'user' => $user
        ));
    }
    
    /**
     * @Route("/user/new", name="user_new")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
               
            $passwordEncoder = $this->get('security.encoder_factory')->getEncoder($user);
            $password = $passwordEncoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $creator = $this->getUser();
            $L = new Logs();
            $L->setAuteur($creator->getFirstname()." ".$creator->getLastname());
            $L->setEntity("User");
            $L->setTypeAction("Creation");
            $L->setIdEntity($user->getId());
            $L->setIdEntityText($user->getFirstname()." ".$user->getLastname());
            $em->persist($L);
            $em->flush();
            
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('user_index');
        }

        return $this->render(
            'AdminBundle:user:new.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/user/list", name="user_index")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AdminBundle:user')->findAll();

        return $this->render(
            'AdminBundle:user:index.html.twig',
            array('users' => $users)
        );
    }
    
    /**
     * Displays a form to edit an existing $user entity.
     *
     * @Route("/user/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AdminBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $creator = $this->getUser();
            $L = new Logs();
            $L->setAuteur($creator->getFirstname()." ".$creator->getLastname());
            $L->setEntity("User");
            $L->setTypeAction("Modification");
            $L->setIdEntity($user->getId());
            $L->setIdEntityText($user->getFirstname()." ".$user->getLastname());
            $this->getDoctrine()->getManager()->persist($L);
            
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('user_index');
        }

        return $this->render('AdminBundle:user:edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a $user entity.
     *
     * @Route("/delete/{id}", name="user_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        try{
            
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            if($user!==null):
                $creator = $this->getUser();
                $L = new Logs();
                $L->setAuteur($creator->getFirstname()." ".$creator->getLastname());
                $L->setEntity("User");
                $L->setTypeAction("Suppression");
                $L->setIdEntity($id);
                $L->setIdEntityText($user->getFirstname()." ".$user->getLastname());
                $this->getDoctrine()->getManager()->persist($L);
                
                $em->remove($user);
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
     * Creates a form to delete a categorieDenree entity.
     *
     * @param CategorieDenree $categorieDenree The categorieDenree entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
