<?php

declare(strict_types=1);

namespace App\Entity;

use App\Item;

final class ItemAdapter
{
    private $id;
    private $name;
    private $sell_in;
    private $quality;

    public function __construct(Item $item)
    {
        $this->setName($item->name);
        $this->setSellIn($item->sell_in);
        $this->setQuality($item->quality);
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setSellIn($sell_in): void
    {
        $this->sell_in = $sell_in;
    }

    public function getSellIn(): int
    {
        return $this->sell_in;
    }

    public function setQuality($quality): void
    {
        $this->quality = $quality;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }
}
