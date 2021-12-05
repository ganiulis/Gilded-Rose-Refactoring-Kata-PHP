<?php

namespace App\Controller;

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
        return new Response('pong!', 200, ['Content-Type' => 'text/plain']);
    }
}
