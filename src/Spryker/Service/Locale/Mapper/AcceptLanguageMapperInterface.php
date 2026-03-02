<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Locale\Mapper;

use Generated\Shared\Transfer\AcceptLanguageTransfer;
use Negotiation\AcceptLanguage;

interface AcceptLanguageMapperInterface
{
    public function mapAcceptLanguageToAcceptLanguageTransfer(
        AcceptLanguage $acceptLanguage,
        AcceptLanguageTransfer $acceptLanguageTransfer
    ): AcceptLanguageTransfer;
}
