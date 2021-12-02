<?php

namespace App\DataFixtures;

use App\Serializer\ItemSerializer;
use App\Serializer\Normalizer\ItemNormalizer;
use App\Serializer\Normalizer\ItemsNormalizer;
use App\Serializer\Retriever\FileContentRetriever;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $serializer = new ItemSerializer(
            new FileContentRetriever(),
            new CsvEncoder(), 
            new ItemsNormalizer(new ItemNormalizer)
        );

        $filepath = __DIR__ . '/../Data/fixture.csv';

        $items = $serializer->deserialize($filepath, 'csv');

        foreach ($items as $item) {
            $manager->persist($item);
        }

        $manager->flush();
    }
}
