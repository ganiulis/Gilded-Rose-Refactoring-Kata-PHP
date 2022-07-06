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

        $result = [];

        foreach ($items as $item) {
            $result[] = [
                "item" => [
                    "id" => $item->getId(),
                    "name" => $item->getName(),
                    "sell_in" => $item->getSellIn(),
                    "quality" => $item->getQuality()
                ]
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

    /**
    * @Route("/item/{id}/id", name="show_one_item_id")
    */
    public function showId(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        return new JsonResponse(["id" => $item->getId()]);
    }

    /**
    * @Route("/item/{id}/name", name="show_one_item_name")
    */
    public function showName(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        return new JsonResponse(["name" => $item->getName()]);
    }

    /**
    * @Route("/item/{id}/sell_in", name="show_one_item_sell_in")
    */
    public function showSellIn(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        return new JsonResponse(["sell_in" => $item->getSellIn()]);
    }

    /**
    * @Route("/item/{id}/quality", name="show_one_item_quality")
    */
    public function showQuality(int $id, ItemRepository $itemRepository): JsonResponse
    {
        $item = $itemRepository->find($id);

        return new JsonResponse(["quality" => $item->getQuality()]);
    }
}
