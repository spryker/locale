<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Locale\Business;

use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Messenger\Business\Model\MessengerInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Locale\Business\Exception\LocaleExistsException;
use Spryker\Zed\Locale\Business\Exception\MissingLocaleException;

/**
 * @method LocaleBusinessFactory getFactory()
 */
class LocaleFacade extends AbstractFacade
{

    /**
     * @param string $localeName
     *
     * @return bool
     */
    public function hasLocale($localeName)
    {
        $localeManager = $this->getFactory()->createLocaleManager();

        return $localeManager->hasLocale($localeName);
    }

    /**
     * @param string $localeName
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\MissingLocaleException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getLocale($localeName)
    {
        $localeManager = $this->getFactory()->createLocaleManager();

        return $localeManager->getLocale($localeName);
    }

    /**
     * @return string
     */
    public function getCurrentLocaleName()
    {
        return \Spryker\Shared\Kernel\Store::getInstance()->getCurrentLocale();
    }

    /**
     * @return array
     */
    public function getAvailableLocales()
    {
        $availableLocales = Store::getInstance()->getLocales();
        $locales = [];
        foreach ($availableLocales as $localeName) {
            $localeInfo = $this->getLocale($localeName);
            $locales[$localeInfo->getIdLocale()] = $localeInfo->getLocaleName();
        }

        return $locales;
    }

    /**
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function getCurrentLocale()
    {
        $localeName = $this->getCurrentLocaleName();

        return $this->getLocale($localeName);
    }

    /**
     * @param string $localeName
     *
     * @throws \Spryker\Zed\Locale\Business\Exception\LocaleExistsException
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function createLocale($localeName)
    {
        $localeManager = $this->getFactory()->createLocaleManager();

        return $localeManager->createLocale($localeName);
    }

    /**
     * @param string $localeName
     *
     * @return void
     */
    public function deleteLocale($localeName)
    {
        $localeManager = $this->getFactory()->createLocaleManager();
        $localeManager->deleteLocale($localeName);
    }

    /**
     * @param MessengerInterface $messenger
     *
     * @return void
     */
    public function install(MessengerInterface $messenger)
    {
        $this->getFactory()->createInstaller($messenger)->install();
    }

}
