<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Business\Writer;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreResponseTransfer;
use Generated\Shared\Transfer\StoreTransfer;

interface LocaleWriterInterface
{
    public function createLocaleStore(StoreTransfer $storeTransfer): StoreResponseTransfer;

    public function updateStoreLocales(StoreTransfer $storeTransfer): StoreResponseTransfer;

    /**
     * @param string $localeName
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\LocaleExistsException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function createLocale(string $localeName): LocaleTransfer;

    public function deleteLocale(string $localeName): void;

    public function updateStoreDefaultLocale(StoreTransfer $storeTransfer): StoreResponseTransfer;
}
