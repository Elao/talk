<?php

namespace FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
