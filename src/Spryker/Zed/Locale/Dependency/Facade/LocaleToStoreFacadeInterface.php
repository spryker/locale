<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface LocaleToStoreFacadeInterface
{
    public function isDynamicStoreEnabled(): bool;

    public function getCurrentStore(bool $fallbackToDefault = false): StoreTransfer;
}
