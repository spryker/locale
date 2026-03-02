<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Business;

use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Locale\Business\Cache\LocaleCache;
use Spryker\Zed\Locale\Business\Cache\LocaleCacheInterface;
use Spryker\Zed\Locale\Business\Expander\StoreExpander;
use Spryker\Zed\Locale\Business\Expander\StoreExpanderInterface;
use Spryker\Zed\Locale\Business\Internal\Install\LocaleInstaller;
use Spryker\Zed\Locale\Business\Reader\LocaleReader;
use Spryker\Zed\Locale\Business\Reader\LocaleReaderInterface;
use Spryker\Zed\Locale\Business\Validator\LocaleValidator;
use Spryker\Zed\Locale\Business\Validator\LocaleValidatorInterface;
use Spryker\Zed\Locale\Business\Writer\LocaleWriter;
use Spryker\Zed\Locale\Business\Writer\LocaleWriterInterface;
use Spryker\Zed\Locale\Dependency\Facade\LocaleToStoreFacadeInterface;
use Spryker\Zed\Locale\LocaleDependencyProvider;

/**
 * @method \Spryker\Zed\Locale\LocaleConfig getConfig()
 * @method \Spryker\Zed\Locale\Persistence\LocaleEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\Locale\Persistence\LocaleRepositoryInterface getRepository()
 */
class LocaleBusinessFactory extends AbstractBusinessFactory
{
    public function createLocaleWriter(): LocaleWriterInterface
    {
        return new LocaleWriter(
            $this->createLocaleReader(),
            $this->getEntityManager(),
        );
    }

    public function createInstaller(): LocaleInstaller
    {
        return new LocaleInstaller(
            $this->getConfig()->getLocaleFile(),
            $this->getRepository(),
            $this->getEntityManager(),
        );
    }

    public function getCurrentLocale(): string
    {
        /* Required by infrastructure, exists only for BC with DMS OFF mode. */
        if (!$this->getStoreFacade()->isDynamicStoreEnabled()) {
            return Store::getInstance()->getCurrentLocale();
        }

        return $this->getProvidedDependency(LocaleDependencyProvider::LOCALE_CURRENT);
    }

    /**
     * @return array<string>
     */
    public function getLocaleList(): array
    {
        return $this->getStoreFacade()->getCurrentStore()->getAvailableLocaleIsoCodes();
    }

    public function createLocaleReader(): LocaleReaderInterface
    {
        return new LocaleReader($this->getRepository(), $this->createLocaleCache(), $this->getStoreFacade());
    }

    public function createLocaleCache(): LocaleCacheInterface
    {
        return new LocaleCache();
    }

    public function createLocaleValidator(): LocaleValidatorInterface
    {
        return new LocaleValidator();
    }

    public function createStoreExpander(): StoreExpanderInterface
    {
        return new StoreExpander($this->getRepository());
    }

    public function getStoreFacade(): LocaleToStoreFacadeInterface
    {
        return $this->getProvidedDependency(LocaleDependencyProvider::FACADE_STORE);
    }
}
