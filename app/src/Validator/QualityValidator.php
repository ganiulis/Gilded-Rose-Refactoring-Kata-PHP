<?php

namespace GildedRose\Validator;

use GildedRose\Item;
use GildedRose\Validator\ValidatorInterface;

class QualityValidator implements ValidatorInterface
{
    /**
     * Checks quality of an Item so number stays within the allowed limits 
     *
     * @param Item $item
     * @return Item
     */
    public function validate(Item $item): Item
    {
        if (strcasecmp('Sulfuras, Hand of Ragnaros', $item->name) === 0) {
            $item->quality = 80;
            return $item;
        }
        
        if ($item->quality > 50) {
            $item->quality = 50;
            return $item;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
            return $item;
        }

        return $item;
    }
}
