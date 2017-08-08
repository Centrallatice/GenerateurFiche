<?php

namespace FicheBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
class SecurityController extends Controller
{
    /**
    * @Route("/login", name="login")
    */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
       
        return $this->render('FicheBundle:user:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    /**
    * @Route("/checkRedirect", name="checkRedirect")
    */
    public function checkRedirectAction()
    {
        if (true === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) { 
            if(true === $this->get('security.authorization_checker')->isGranted('ROLE_ADMINISTRATEUR')):
                return $this->redirectToRoute("admin_default_index");
            elseif(true === $this->get('security.authorization_checker')->isGranted('ROLE_CREATEUR')):
                return $this->redirectToRoute("admin_default_index");
            elseif(true === $this->get('security.authorization_checker')->isGranted('ROLE_LECTEUR')):
                return $this->redirectToRoute("fiche_default_index");
            else:
                return $this->redirectToRoute("login");
            endif;
        }
        else{
            return $this->redirectToRoute("login");
        }
    }
  
    /**
    * @Method({"POST"})
    * @Route("/login_check", name="login_check")
    */
    public function check()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
    
    /**
    * @Method({"GET"})
    * @Route("/logout", name="logout")
    */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
