<?php

declare(strict_types=1);

Namespace GildedRose\DataProcessing;

require_once __DIR__ . '/../../vendor/autoload.php';

use GildedRose\DataProcessing\DataDecoderInterface;

use Symfony\Component\Serializer\Encoder\CsvEncoder;

/**
 * Custom reusable datafile decoder helper class.
 */
class DataDecoder implements DataDecoderInterface
{
    private const DATA_DIR = __DIR__ . "\\..\\..\\data\\";
    /**
     * Returns an array of decoded data from the app/data folder.
     * 
     * Currently only accepts csv files.
     *
     * @param string $dataFile The filename for the file to be decoded
     * @param string $dataType The type of data to be retrieved
     */
    public function decodeFile(string $dataFile, string $dataType): array
    {
        switch($dataType) {
            case 'csv':
                $encoder = new CsvEncoder();
                $encodedData = file_get_contents($this::DATA_DIR . $dataFile);
                $decodedData = $encoder->decode($encodedData, 'csv');
                break;
            default:
                break;
        }
        return $decodedData;
    }
}
