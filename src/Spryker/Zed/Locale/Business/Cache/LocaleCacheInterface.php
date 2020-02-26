<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Business\Cache;

use Generated\Shared\Transfer\LocaleTransfer;

interface LocaleCacheInterface
{
    /**
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer|null
     */
    public function findByName(string $localeName): ?LocaleTransfer;

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     */
    public function set(LocaleTransfer $localeTransfer): void;
}
