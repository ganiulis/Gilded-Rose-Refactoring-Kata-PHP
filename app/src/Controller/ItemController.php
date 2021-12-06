<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{
    /**
    * @Route("/item", name="show_all_items")
    */
    public function showAll(ItemRepository $itemRepository): JsonResponse
    {
        $items = $itemRepository->findAll();

        foreach ($items as $item) {
            $output[] = [$item->getId() => $item->__toString()];
        } 

        return new JsonResponse($output);
    }

    /**
    * @Route("/item/{id}", name="show_one_item")
    */
    public function show(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        return new JsonResponse($item->__toString());
    }
}
