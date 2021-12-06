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
            return new Response('pong!', 200, ['Content-Type' => 'text/plain']);
        } catch (Exception $e) {
            return new Response('something is wrong with the db connection.', 500, ['Content-Type' => 'text/plain']);
        }
    }
}
