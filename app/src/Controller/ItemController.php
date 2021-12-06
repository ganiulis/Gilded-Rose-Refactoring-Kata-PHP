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
            $result[] = [
                "id" => $item->getId(),
                "name" => $item->getName(),
                "sell_in" => $item->getSellIn(),
                "quality" => $item->getQuality()
            ];
        } 

        return new JsonResponse(["items" => $result]);
    }

    /**
    * @Route("/item/{id}", name="show_one_item")
    */
    public function show(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        $result = [
            "id" => $item->getId(),
            "name" => $item->getName(),
            "sell_in" => $item->getSellIn(),
            "quality" => $item->getQuality()
        ];

        return new JsonResponse(["item" => $result]);
    }
}
