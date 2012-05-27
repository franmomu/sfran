<?php

namespace Fran\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/secured/", name="secured_home")
     * @Template()
     */
    public function indexAction()
    {
    	$name = $this->get('security.context')->getToken()->getUser()->getUsername();
        return array('name' => $name);
    }
}
