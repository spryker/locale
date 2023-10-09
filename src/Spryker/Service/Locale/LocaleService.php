<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Locale;

use Negotiation\AcceptLanguage;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \Spryker\Service\Locale\LocaleServiceFactory getFactory()
 */
class LocaleService extends AbstractService implements LocaleServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $acceptLanguageHeader
     * @param array<int, string> $priorities
     * @param bool $strict
     *
     * @return \Negotiation\AcceptLanguage|null
     */
    public function getAcceptLanguage(string $acceptLanguageHeader, array $priorities, bool $strict = false): ?AcceptLanguage
    {
        return $this->getFactory()
            ->getLanguageNegotiator()
            ->getAcceptLanguage($acceptLanguageHeader, $priorities, $strict);
    }
}
