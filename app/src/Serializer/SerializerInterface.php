<?php

namespace App\Serializer;

interface SerializerInterface
{
    public function deserialize(string $directory, string $type): array;
}
