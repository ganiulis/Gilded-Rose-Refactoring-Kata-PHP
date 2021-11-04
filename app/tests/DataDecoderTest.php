<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use GildedRose\DataDecoder;

class DataDecoderTest extends TestCase
{
    public function testDataDecoder(): void
    {
        $decoder = new DataDecoder();

        $decodedFixtureData = $decoder->retrieveData('testfixture.csv', 'csv');

        $this->assertIsArray($decodedFixtureData, 'DataDecoder class does not return an array!');
        $this->assertNotEmpty($decodedFixtureData, 'DataDecoder class is empty!');
    }
}
