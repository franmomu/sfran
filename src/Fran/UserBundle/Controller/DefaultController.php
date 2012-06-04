<?php

namespace Fran\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;


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

    /**
     * @Route("/connectTwitter", name="connect_twitter")
     *
     */
    public function connectTwitterAction()
    {

      $request = $this->get('request');
      $twitter = $this->get('fos_twitter.service');

      $authURL = $twitter->getLoginUrl($request);

      $response = new RedirectResponse($authURL);

      return $response;

    }
}
