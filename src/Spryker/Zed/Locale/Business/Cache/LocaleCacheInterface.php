<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Business\Cache;

use Generated\Shared\Transfer\LocaleTransfer;

interface LocaleCacheInterface
{
    public function findByName(string $localeName): ?LocaleTransfer;

    public function findById(int $idLocale): ?LocaleTransfer;

    public function set(LocaleTransfer $localeTransfer): void;
}
