<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Locale\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Locale\Communication\Plugin\Customer\LocaleCustomerValidatorPlugin;
use SprykerTest\Zed\Locale\LocaleBusinessTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group Locale
 * @group Business
 * @group CustomerLocaleValidatorTest
 * Add your own group annotations below this line
 */
class CustomerLocaleValidatorTest extends Unit
{
    protected const string KNOWN_LOCALE_NAME = 'de_DE';

    protected const string UNKNOWN_LOCALE_NAME = 'xx_XX';

    protected LocaleBusinessTester $tester;

    public function testValidateCustomerLocaleAcceptsAKnownLocale(): void
    {
        // Arrange
        $customerTransfer = (new CustomerTransfer())
            ->setLocale((new LocaleTransfer())->setLocaleName(static::KNOWN_LOCALE_NAME));

        // Act
        $customerResponseTransfer = (new LocaleCustomerValidatorPlugin())->validate($customerTransfer);

        // Assert
        $this->assertTrue($customerResponseTransfer->getIsSuccess());
        $this->assertCount(0, $customerResponseTransfer->getErrors());
    }

    public function testValidateCustomerLocaleAcceptsACustomerWithoutALocale(): void
    {
        // Act
        $customerResponseTransfer = (new LocaleCustomerValidatorPlugin())->validate(new CustomerTransfer());

        // Assert
        $this->assertTrue($customerResponseTransfer->getIsSuccess());
    }

    public function testValidateCustomerLocaleRejectsALocaleThatDoesNotExist(): void
    {
        // Arrange
        $customerTransfer = (new CustomerTransfer())
            ->setLocale((new LocaleTransfer())->setLocaleName(static::UNKNOWN_LOCALE_NAME));

        // Act
        $customerResponseTransfer = (new LocaleCustomerValidatorPlugin())->validate($customerTransfer);

        // Assert
        $this->assertFalse($customerResponseTransfer->getIsSuccess());
        $this->assertCount(1, $customerResponseTransfer->getErrors());
        $this->assertNotEmpty($customerResponseTransfer->getErrors()->offsetGet(0)->getMessage());
    }
}
