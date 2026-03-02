<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Persistence;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface LocaleEntityManagerInterface
{
    public function createLocaleStore(StoreTransfer $storeTransfer, LocaleTransfer $localeTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     * @param array<\Generated\Shared\Transfer\LocaleTransfer> $localeTransfers
     *
     * @return void
     */
    public function updateStoreLocales(StoreTransfer $storeTransfer, array $localeTransfers): void;

    public function updateStoreDefaultLocale(StoreTransfer $storeTransfer, LocaleTransfer $localeTransfer): void;

    public function createLocale(string $localeName): LocaleTransfer;

    public function deleteLocale(string $localeName): void;
}
