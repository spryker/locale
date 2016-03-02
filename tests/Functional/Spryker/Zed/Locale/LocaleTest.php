<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\Spryker\Zed\Locale;

use Codeception\TestCase\Test;
use Spryker\Zed\Locale\Business\LocaleFacade;
use Spryker\Zed\Locale\Persistence\LocaleQueryContainer;

class LocaleTest extends Test
{

    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacade
     */
    protected $localeFacade;

    /**
     * @var \Spryker\Zed\Locale\Persistence\LocaleQueryContainerInterface
     */
    protected $localeQueryContainer;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->localeFacade = new LocaleFacade();
        $this->localeQueryContainer = new LocaleQueryContainer();
    }

    /**
     * @group Locale
     *
     * @return void
     */
    public function testCreateLocaleInsertsSomething()
    {
        $localeQuery = $this->localeQueryContainer->queryLocaleByName('xy_ab');
        $this->assertEquals(0, $localeQuery->count());

        $this->localeFacade->createLocale('xy_ab');

        $this->assertEquals(1, $localeQuery->count());
    }

    /**
     * @group Locale
     *
     * @return void
     */
    public function testDeleteLocaleDeletesSoftly()
    {
        $localeQuery = $this->localeQueryContainer->queryLocaleByName('ab_xy');
        $this->localeFacade->createLocale('ab_xy');

        $this->assertTrue($localeQuery->findOne()->getIsActive());
        $this->localeFacade->deleteLocale('ab_xy');
        $this->assertFalse($localeQuery->findOne()->getIsActive());
    }

}
