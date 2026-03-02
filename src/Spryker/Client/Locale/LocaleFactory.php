<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Locale;

use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Locale\Dependency\Client\LocaleToStoreClientInterface;
use Spryker\Client\Locale\Reader\LanguageReader;
use Spryker\Client\Locale\Reader\LanguageReaderInterface;
use Spryker\Client\Locale\Reader\LocaleReader;
use Spryker\Client\Locale\Reader\LocaleReaderInterface;

class LocaleFactory extends AbstractFactory
{
    public function createLanguageReader(): LanguageReaderInterface
    {
        return new LanguageReader();
    }

    public function createLocaleReader(): LocaleReaderInterface
    {
        return new LocaleReader(
            $this->getStoreClient(),
            $this->createLanguageReader(),
        );
    }

    public function getLocaleCurrent(): string
    {
        return $this->getProvidedDependency(LocaleDependencyProvider::LOCALE_CURRENT);
    }

    public function getStoreClient(): LocaleToStoreClientInterface
    {
        return $this->getProvidedDependency(LocaleDependencyProvider::CLIENT_STORE);
    }
}
