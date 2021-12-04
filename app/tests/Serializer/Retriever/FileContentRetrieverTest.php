<?php

namespace App\Tests\Serializer\Retriever;

use App\Serializer\Retriever\FileContentRetriever;
use ApprovalTests\Approvals;
use PHPUnit\Framework\TestCase;

class FileContentRetrieverTest extends TestCase
{
    public function setUp(): void
    {
        $this->retriever = new FileContentRetriever();
    }

    public function testRetrieveTxt(): void
    {
        $content = $this->retriever->retrieve(__DIR__.'/testContent.txt');

        Approvals::verifyString($content);
    }

    public function testRetrieveCsv(): void
    {
        $content = $this->retriever->retrieve(__DIR__.'/testContent.csv');

        Approvals::verifyString($content);
    }

    public function testRetrieveJson(): void
    {
        $content = $this->retriever->retrieve(__DIR__.'/testContent.json');

        Approvals::verifyString($content);
    }
}
