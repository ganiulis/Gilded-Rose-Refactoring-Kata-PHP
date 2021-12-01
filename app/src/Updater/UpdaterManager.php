<?php

declare(strict_types=1);

namespace App\Updater;

use App\Entity\Item;
use App\Updater\UpdaterInterface;

/**
 * Used for updating an array of Items.
 */
class UpdaterManager
{
    public function __construct(
        UpdaterInterface $defaultUpdater,
        array $updaters
    ) {
        $this->defaultUpdater = $defaultUpdater;

        foreach ($updaters as $updater) {
            $this->addUpdater($updater);
        }
    }

    private function addUpdater(UpdaterInterface $updater): void
    {
        $this->updaters[] = $updater;
    }

    /**
     * Updates quality of one Item. Checks through non-default Updaters first before calling DefaultUpdater.
     *
     * @param Item $item Item to be updated
     * @return void
     */
    public function update(Item $item): void
    {
        if (isset($this->updaters)) {
            foreach ($this->updaters as $updater) {
                if ($updater->supports($item)) {
                    $updater->update($item);
                    return;
                }
            }
        }
        $this->defaultUpdater->update($item);
    }

    /**
     * Updates quality of selected array of Items. Checks through non-default Updaters first before calling DefaultUpdater.
     *
     * @param array $items Items array to be updated
     * @return array updated Items array
     */
    public function updateAll(array $items): array
    {
        foreach ($items as $item) {
            $this->update($item);
        }
        return $items;
    }

}
