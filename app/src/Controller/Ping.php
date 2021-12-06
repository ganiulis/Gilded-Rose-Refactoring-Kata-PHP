<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ping extends AbstractController
{
    /**
     * @Route("/ping", name="check_health")
     */
    public function checkHealth(): Response
    {
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->getConnection()->connect();
        } catch (Exception $e) {
            return new Response('there was an error while trying to connect to the db.', 500, ['Content-Type' => 'text/plain']);
        }

        $connected = $em->getConnection()->isConnected();

        if (!$connected) {
            return new Response('db connection process did not produce any errors but is unavailable.', 503, ['Content-Type' => 'text/plain']);
        }

        return new Response('pong!', 200, ['Content-Type' => 'text/plain']);
    }
}
