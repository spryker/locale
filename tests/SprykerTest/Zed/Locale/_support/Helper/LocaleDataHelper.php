<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Locale\Helper;

use Codeception\Module;
use Generated\Shared\DataBuilder\LocaleBuilder;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use ReflectionClass;
use Spryker\Zed\Locale\Business\Cache\LocaleCache;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;

class LocaleDataHelper extends Module
{
    use LocatorHelperTrait;

    /**
     * @var int
     */
    public const LOCALE_NAME_LENGTH_LIMIT = 5;

    public function haveLocale(array $seedData = []): LocaleTransfer
    {
        $localeTransfer = $this->generateLocaleTransfer($seedData);

        if ($this->getLocaleFacade()->hasLocale($localeTransfer->getLocaleName())) {
            $this->resetLocaleCacheClass();

            return $this->getLocaleFacade()->getLocale($localeTransfer->getLocaleName());
        }

        return $this->getLocaleFacade()->createLocale($localeTransfer->getLocaleName());
    }

    public function haveLocaleStore(int $idStore, int $idLocale): int
    {
        $localeStoreEntity = $this->createLocaleStorePropelQuery()
            ->filterByFkStore($idStore)
            ->filterByFkLocale($idLocale)
            ->findOneOrCreate();

        $localeStoreEntity->save();

        return $localeStoreEntity->getIdLocaleStore();
    }

    public function localeStoreExists(int $idStore, int $idLocale): bool
    {
        return $this->createLocaleStorePropelQuery()
            ->filterByFkStore($idStore)
            ->filterByFkLocale($idLocale)
            ->exists();
    }

    public function deleteLocaleStore(int $idStore): void
    {
        $this->createLocaleStorePropelQuery()
            ->filterByFkStore($idStore)
            ->delete();
    }

    public function getDefaultLocaleByIdStore(int $idStore): int
    {
        return $this->createStorePropelQuery()
            ->findPk($idStore)
            ->getFkLocale();
    }

    public function ensureStoreLocaleDatabaseTableIsEmpty(): void
    {
        $localeStoreQuery = $this->createLocaleStorePropelQuery();
        $localeStoreQuery->deleteAll();
    }

    public function countLocaleStoreRelations(int $idLocale): int
    {
        return $this->createLocaleStorePropelQuery()
            ->filterByFkLocale($idLocale)
            ->count();
    }

    public function getDefaultLocaleIdByStoreName(string $storeName): int
    {
        return $this->createStorePropelQuery()
            ->findOneByName($storeName)
            ->getFkLocale();
    }

    protected function createStorePropelQuery(): SpyStoreQuery
    {
        return SpyStoreQuery::create();
    }

    protected function createLocaleStorePropelQuery(): SpyLocaleStoreQuery
    {
        return SpyLocaleStoreQuery::create();
    }

    protected function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getLocator()->locale()->facade();
    }

    /**
     * @param array $seedData
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function generateLocaleTransfer(array $seedData = [])
    {
        $localeTransfer = (new LocaleBuilder($seedData))->build();

        if (strlen($localeTransfer->getLocaleName()) > static::LOCALE_NAME_LENGTH_LIMIT) {
            return $this->generateLocaleTransfer($seedData);
        }

        return $localeTransfer;
    }

    protected function resetLocaleCacheClass(): void
    {
        $class = new ReflectionClass(LocaleCache::class);
        $localeCache = $class->getProperty('localeCache');
        $localeCache->setAccessible(true);
        $localeCache->setValue([]);

        $localeCacheById = $class->getProperty('localeCacheById');
        $localeCacheById->setAccessible(true);
        $localeCacheById->setValue([]);
    }
}
