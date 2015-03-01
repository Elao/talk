<?php

namespace ImportBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * API Controller
 */
class ApiController extends Controller
{
    /**
     * @Route("/oauth2callback", name="api_callback")
     */
    public function callbackAction(Request $request)
    {
        $logger = $this->get('logger');

        foreach ($request->query as $key => $value) {
            $logger->info(sprintf('[%s] %s', $key, $value));
        }

        return new Response(null , Response::HTTP_NO_CONTENT);
    }
}
