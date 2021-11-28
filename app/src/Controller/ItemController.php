<?php
namespace App\Controller;

use App\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
     * @Route("/item/{id}", name="view_item")
     */
    public function item(int $id): Response
    {
        $item = $this->getDoctrine()
            ->getRepository(Item::class)
            ->find($id);

        if (!$item) {
            throw $this->createNotFoundException(
                'No item found for id '.$id
            );
        }

        return new Response(
            '<html>
                <body>
                    Item name: '.$item->name.'.'.
                    'Item expires in '. $item->sell_in .' days'.
                    'Item quality is: '.$item->quality.'
                </body>
            </html>'
        );
    }
}
