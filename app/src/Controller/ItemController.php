<?php
namespace App\Controller;

use App\Entity\Item;
use App\Printer\StockPrinter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
     * @Route("/item", name="view_item")
     */
    public function findAll(ManagerRegistry $doctrine): Response
    {
        $items = $doctrine->getRepository(Item::class)->findAll();

        if (!$items) {
            throw $this->createNotFoundException(
                'No items found'
            );
        }

        $printer = new StockPrinter();

        $summary = $printer->printSummary($items, 0);

        return new Response(
            '<html>
                <body>'.
                    $summary
                .'</body>
            </html>'
        );
    }
}
