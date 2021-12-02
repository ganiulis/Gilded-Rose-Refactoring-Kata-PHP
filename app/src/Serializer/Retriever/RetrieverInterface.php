<?php

namespace App\Serializer\Retriever;

interface RetrieverInterface
{
    public function retrieve(string $location): string;
}
