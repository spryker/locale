<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Business\Validator;

use Generated\Shared\Transfer\CustomerErrorTransfer;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Locale\Persistence\LocaleRepositoryInterface;

class CustomerLocaleValidator implements CustomerLocaleValidatorInterface
{
    protected const string ERROR_MESSAGE_LOCALE_UNKNOWN = 'locale.validation.unknown_locale';

    public function __construct(protected LocaleRepositoryInterface $localeRepository)
    {
    }

    public function validateCustomerLocale(CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        $customerResponseTransfer = (new CustomerResponseTransfer())
            ->setCustomerTransfer($customerTransfer)
            ->setIsSuccess(true);

        $localeName = $customerTransfer->getLocale()?->getLocaleName();

        if (!$localeName || $this->localeRepository->findLocaleByLocaleName($localeName) !== null) {
            return $customerResponseTransfer;
        }

        return $customerResponseTransfer
            ->setIsSuccess(false)
            ->addError((new CustomerErrorTransfer())->setMessage(static::ERROR_MESSAGE_LOCALE_UNKNOWN));
    }
}
