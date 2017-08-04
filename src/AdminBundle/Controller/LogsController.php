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

class LogsController extends Controller{
    
    /**
     * @Route("/logs/index", name="logs_index")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logs = $em->getRepository(Logs::class)->findBy(array(),array("dateAction"=>"DESC"));

        return $this->render(
            'AdminBundle:logs:index.html.twig',
            array('logs' => $logs)
        );
    }
}
