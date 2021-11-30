<?php

declare(strict_types=1);

namespace App\Entity;

final class Item
{
    private $id;
    private $name;
    private $sell_in;
    private $quality;

    public function getId(): int
    {
        return $this->id;
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
