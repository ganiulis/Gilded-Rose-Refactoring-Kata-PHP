<?php

namespace App\Serializer\Retriever;

use App\Serializer\Retriever\RetrieverInterface;

use SplFileInfo;

/**
 * Helper class for getting data from files.
 */
class FileContentRetriever implements RetrieverInterface
{
    /**
     * Retrieves data based on filepath.
     *
     * @param string $filepath
     * @return string $content
     */
    public function retrieve(string $filepath): string
    {
        $fileinfo = new SplFileInfo($filepath);

        $filepath = $fileinfo->getRealPath();

        $content = file_get_contents($filepath);

        return $content;
    }
}
