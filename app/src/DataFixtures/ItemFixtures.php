<?php

namespace App\DataFixtures;

use App\Data\FileContentRetriever;
use App\Entity\Item;
use App\Repository\ItemOldRepository;
use App\Serializer\ItemNormalizer; 
use App\Serializer\ItemsNormalizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $repository = new ItemOldRepository(
            new FileContentRetriever(),
            new CsvEncoder(), 
            new ItemsNormalizer(new ItemNormalizer)
        );

        $filepath = __DIR__ . '/testfixture.csv';

        $repository->setItems($filepath, 'csv');
        $items = $repository->getItems();

        foreach ($items as $item) {
            $adaptedItem = new Item();

            $adaptedItem->setName($item->name);
            $adaptedItem->setSellIn($item->sell_in);
            $adaptedItem->setQuality($item->quality);

            $manager->persist($adaptedItem);
        }

        $manager->flush();
    }
}
