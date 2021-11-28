<?php

namespace App\Data;

/**
 * Currently only obligates to include denormalization for arrays.
 */
interface ContentRetrieverInterface
{
    public function retrieveContent(string $location): string;
}
