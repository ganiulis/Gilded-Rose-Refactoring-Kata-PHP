<?php

namespace App\Data;

use App\Data\ContentRetrieverInterface;

use SplFileInfo;

/**
 * Helper class.
 * 
 * Retrieves content of a file through an absolute path.
 */
class FileContentRetriever implements ContentRetrieverInterface
{
    /**
     * @param string $filepath path to the file
     * @return string returns content of a file in string format
     */
    public function retrieveContent(string $filepath): string
    {
        $fileinfo = new SplFileInfo($filepath);
        $filepath = $fileinfo->getRealPath();
        return file_get_contents($filepath);
    }
}
