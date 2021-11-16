<?php 

namespace GildedRose\Validator;

use GildedRose\Item;

interface ValidatorInterface
{
    public function validate(Item $item): Item;
}
