<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TalkController extends Controller
{
    /**
     * @Route("/", name="talks")
     */
    public function listAction()
    {
        return ['talks' => $talks];
    }
}
