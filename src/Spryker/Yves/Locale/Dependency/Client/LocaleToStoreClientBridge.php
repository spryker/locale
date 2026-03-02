<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\Locale\Dependency\Client;

use Generated\Shared\Transfer\StoreTransfer;

class LocaleToStoreClientBridge implements LocaleToStoreClientInterface
{
    /**
     * @var \Spryker\Client\Store\StoreClientInterface
     */
    protected $storeClient;

    /**
     * @param \Spryker\Client\Store\StoreClientInterface $storeClient
     */
    public function __construct($storeClient)
    {
        $this->storeClient = $storeClient;
    }

    public function getCurrentStore(): StoreTransfer
    {
        return $this->storeClient->getCurrentStore();
    }

    public function isDynamicStoreEnabled(): bool
    {
        return $this->storeClient->isDynamicStoreEnabled();
    }

    public function getStoreByName(string $storeName): StoreTransfer
    {
        return $this->storeClient->getStoreByName($storeName);
    }
}
