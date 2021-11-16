<?php 

namespace GildedRose\Validator;

use GildedRose\Item;

interface ValidatorInterface
{
    public function supports(Item $item): bool;
    public function validate(Item $item): Item;
}
