<?php

namespace App\Serializer\Normalizer;

/**
 * Obligates to denormalize an array of data into an object.
 */
interface NormalizerInterface
{
    public function denormalize(array $data): object;
}
