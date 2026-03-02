<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Locale;

use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;
use Spryker\Service\Locale\Dependency\External\LocaleToLanguageNegotiatorAdapter;

class LocaleDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const LANGUAGE_NEGOTIATOR = 'LANGUAGE_NEGOTIATOR';

    public function provideServiceDependencies(Container $container): Container
    {
        $container = parent::provideServiceDependencies($container);

        $container = $this->addLanguageNegotiator($container);

        return $container;
    }

    public function addLanguageNegotiator(Container $container): Container
    {
        $container->set(static::LANGUAGE_NEGOTIATOR, function () {
            return new LocaleToLanguageNegotiatorAdapter();
        });

        return $container;
    }
}
