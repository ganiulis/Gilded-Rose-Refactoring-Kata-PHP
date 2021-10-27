<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item)
        {
            $itemType = preg_match('/\bConjured\b/i', $item->name) ? 'Conjured Item' : $item->name;
            
            switch($itemType)
            {
                case 'Aged Brie':
                    if ($item->sell_in < 1 && $item->quality < 49)
                    {
                        $item->quality += 2;
                    }
                    elseif ($item->quality < 50)
                    {
                        $item->quality += 1;
                    }
                    $item->sell_in -= 1;
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    if ($item->sell_in < 1)
                    {
                        $item->quality = 0;
                    }
                    else
                    {
                        if ($item->sell_in < 6 && $item->quality < 48)
                        {
                            $item->quality += 3;
                        }
                        elseif ($item->sell_in < 11 && $item->quality < 49)
                        {
                            $item->quality += 2;
                        }
                        elseif ($item->quality < 50)
                        {
                            $item->quality += 1;
                        }
                    }
                    $item->sell_in -= 1;
                    break;

                case 'Conjured Item':
                    if ($item->sell_in < 1 && $item->quality > 3)
                    {
                        $item->quality -= 4;
                    }
                    elseif ($item->quality > 1)
                    {
                        $item->quality -= 2;
                    }
                    elseif ($item->quality > 0)
                    {
                        $item->quality -= 1;
                    }
                    $item->sell_in -= 1;
                    break;

                case 'Sulfuras, Hand of Ragnaros':
                    break;

                default:
                    if ($item->sell_in < 1 && $item->quality > 1)
                    {
                        $item->quality -= 2;
                    }
                    elseif ($item->quality > 0)
                    {
                        $item->quality -= 1;
                    }
                    $item->sell_in -= 1;
                    break;

            }
        }
    }
}
