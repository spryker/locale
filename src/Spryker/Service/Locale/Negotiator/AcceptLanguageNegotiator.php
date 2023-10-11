<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Locale\Negotiator;

use Generated\Shared\Transfer\AcceptLanguageTransfer;
use Spryker\Service\Locale\Dependency\External\LocaleToLanguageNegotiatorInterface;
use Spryker\Service\Locale\Mapper\AcceptLanguageMapperInterface;

class AcceptLanguageNegotiator implements AcceptLanguageNegotiatorInterface
{
    /**
     * @param \Spryker\Service\Locale\Dependency\External\LocaleToLanguageNegotiatorInterface $languageNegotiator
     * @param \Spryker\Service\Locale\Mapper\AcceptLanguageMapperInterface $acceptLanguageMapper
     */
    public function __construct(
        protected LocaleToLanguageNegotiatorInterface $languageNegotiator,
        protected AcceptLanguageMapperInterface $acceptLanguageMapper
    ) {
        $this->languageNegotiator = $languageNegotiator;
        $this->acceptLanguageMapper = $acceptLanguageMapper;
    }

    /**
     * @param string $acceptLanguageHeader
     * @param array<int, string> $priorities
     * @param bool $strict
     *
     * @return \Generated\Shared\Transfer\AcceptLanguageTransfer|null
     */
    public function getAcceptLanguage(
        string $acceptLanguageHeader,
        array $priorities,
        bool $strict = false
    ): ?AcceptLanguageTransfer {
        $acceptLanguage = $this->languageNegotiator->getAcceptLanguage($acceptLanguageHeader, $priorities, $strict);

        if (!$acceptLanguage) {
            return null;
        }

        return $this->acceptLanguageMapper->mapAcceptLanguageToAcceptLanguageTransfer($acceptLanguage, new AcceptLanguageTransfer());
    }
}
