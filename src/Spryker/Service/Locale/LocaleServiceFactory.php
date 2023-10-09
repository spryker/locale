<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Locale;

use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Service\Locale\Dependency\External\LocaleToLanguageNegotiatorInterface;

class LocaleServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \Spryker\Service\Locale\Dependency\External\LocaleToLanguageNegotiatorInterface
     */
    public function getLanguageNegotiator(): LocaleToLanguageNegotiatorInterface
    {
        return $this->getProvidedDependency(LocaleDependencyProvider::LANGUAGE_NEGOTIATOR);
    }
}
