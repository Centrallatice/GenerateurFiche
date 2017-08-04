<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
class SecurityController extends Controller
{
    /**
    * @Route("/login", name="login_admin")
    */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
       
        return $this->render('AdminBundle:user:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
  
    /**
    * @Method({"POST"})
    * @Route("/login_admin_check", name="login_admin_check")
    */
    public function check()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
    
    /**
    * @Method({"GET"})
    * @Route("/logout", name="logout_admin")
    */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
