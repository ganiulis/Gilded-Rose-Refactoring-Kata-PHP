<?php

declare(strict_types=1);

namespace GildedRose;

/**
 * Used for updating an array of Items.
 */
final class GildedRose
{
    private const AGED_BRIE = 'Aged Brie';
    private const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    private const CONJURED = 'Conjured Item';
    private const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    /**
     * Updated quality of selected array of Items
     *
     * @param array $items Items array to be updated
     * @return array updated Items array
     */
    public function updateQuality(array $items): array
    {
        foreach ($items as $item) {
            $itemType = preg_match('/\bConjured\b/i', $item->name) ? self::CONJURED : $item->name;
            
            switch($itemType) {
                case self::AGED_BRIE:
                    if ($item->sell_in < 1 && $item->quality < 49) {
                        $item->quality += 2;
                    } elseif ($item->quality < 50) {
                        $item->quality += 1;
                    }
                    $item->sell_in -= 1;
                    break;
                case self::BACKSTAGE_PASSES:
                    if ($item->sell_in < 1) {
                        $item->quality = 0;
                    } else {
                        if ($item->sell_in < 6 && $item->quality < 48) {
                            $item->quality += 3;
                        } elseif ($item->sell_in < 11 && $item->quality < 49) {
                            $item->quality += 2;
                        } elseif ($item->quality < 50) {
                            $item->quality += 1;
                        }
                    }
                    $item->sell_in -= 1;
                    break;
                case self::CONJURED:
                    if ($item->sell_in < 1) {
                        if ($item->quality > 3) {
                            $item->quality -= 4;
                        } elseif ($item->quality > 0) {
                            $item->quality = 0;
                        }
                    } elseif ($item->quality > 1) {
                        $item->quality -= 2;
                    } elseif ($item->quality > 0) {
                        $item->quality -= 1;
                    }
                    $item->sell_in -= 1;
                    break;
                case self::SULFURAS:
                    break;
                default:
                    if ($item->sell_in < 1 && $item->quality > 1) {
                        $item->quality -= 2;
                    } elseif ($item->quality > 0) {
                        $item->quality -= 1;
                    }
                    $item->sell_in -= 1;
                    break;
            }
        }
        return $items;
    }
}
