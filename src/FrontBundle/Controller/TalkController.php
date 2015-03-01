<?php

namespace FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TalkController extends Controller
{
    /**
     * @Route("/", name="talks")
     * @Template(":talk:list.html.twig")
     */
    public function listAction()
    {
        $talks = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('Model:Talk')
            ->findAll();

        return ['talks' => $talks];
    }

    /**
     * @Route("/api", name="api_callback")
     * @Template(":talk:list.html.twig")
     */
    public function callbackAction(Request $request)
    {
        var_dump($request);
        die();
    }
}
