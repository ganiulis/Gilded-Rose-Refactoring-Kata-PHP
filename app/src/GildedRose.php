<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Updater;

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
    public function updateItems(array $items): array
    {
        foreach ($items as $item) {
            $itemType = preg_match('/\bConjured\b/i', $item->name) ? self::CONJURED : $item->name;

            switch($itemType) {
                case self::AGED_BRIE:
                    $this->itemUpdater = new Updater\BrieUpdater;
                    break;
                case self::BACKSTAGE_PASSES:
                    $this->itemUpdater = new Updater\BackstageUpdater;
                    break;
                case self::CONJURED:
                    $this->itemUpdater = new Updater\ConjuredUpdater;
                    break;
                case self::SULFURAS:
                    $this->itemUpdater = new Updater\SulfurasUpdater;
                    break;
                default:
                    $this->itemUpdater = new Updater\DefaultUpdater;
                    break;
                }
            $this->itemUpdater->updateItem($item);
        }
        return $items;
    }
}
