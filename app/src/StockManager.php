<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Item;
use GildedRose\Updater\UpdaterInterface;
use GildedRose\Validator\ValidatorInterface;

/**
 * Used for updating an array of Items.
 */
class StockManager
{
    public function __construct(
        UpdaterInterface $defaultUpdater,
        array $updaters,
        ValidatorInterface $defaultValidator,
        array $validators
    ) {
        $this->defaultUpdater = $defaultUpdater;

        foreach ($updaters as $updater) {
            $this->addUpdater($updater);
        }

        $this->defaultValidator = $defaultValidator;

        foreach ($validators as $validator) {
            $this->addValidator($validator);
        }
    }

    private function addUpdater(UpdaterInterface $updater): void
    {
        $this->updaters[] = $updater;
    }

    private function addValidator(ValidatorInterface $validator): void
    {
        $this->validators[] = $validator;
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

    /**
     * Validates quality of one Item. Checks through non-default Validators first before calling DefaultValidator.
     *
     * @param Item $item Item to be validated
     * @return void
     */
    public function validate(Item $item): void
    {
        if (isset($this->validators)) {
            foreach ($this->validators as $validator) {
                if ($validator->supports($item)) {
                    $validator->validate($item);
                    return;
                }
            }
        }
        $this->defaultValidator->validate($item);
    }

    public function validateAll(array $items): array
    {
        foreach ($items as $item) {
            $this->validate($item);
        }
        return $items;
    }
}
