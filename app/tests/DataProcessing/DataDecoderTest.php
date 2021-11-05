<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\DataProcessing\DataDecoder;

class DataDecoderTest extends TestCase
{
    public function testDataDecoder(): void
    {
        $decoder = new DataDecoder();

        $decodedFixtureData = $decoder->decodeFile('testfixture.csv', 'csv');

        $this->assertIsArray($decodedFixtureData, 'DataDecoder class does not return an array!');
        $this->assertNotEmpty($decodedFixtureData, 'DataDecoder class is empty!');
    }
}
