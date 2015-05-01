<?php

/*
 * (c) Copyright Spryker Systems GmbH 2015
 */

namespace SprykerEngine\Zed\Locale\Business\Internal\Install;

use SprykerFeature\Zed\Installer\Business\Model\AbstractInstaller;
use Propel\Runtime\Exception\PropelException;
use SprykerEngine\Zed\Locale\Persistence\LocaleQueryContainerInterface;
use SprykerEngine\Zed\Locale\Persistence\Propel\SpyLocale;

class LocaleInstaller extends AbstractInstaller
{
    /**
     * @var string
     */
    protected $localeFile;

    /**
     * @var LocaleQueryContainerInterface
     */
    protected $localeQueryContainer;

    /**
     * @param LocaleQueryContainerInterface $localeQueryContainer
     * @param string $localeFile
     */
    public function __construct(LocaleQueryContainerInterface $localeQueryContainer, $localeFile)
    {
        $this->localeFile = $localeFile;
        $this->localeQueryContainer = $localeQueryContainer;
    }

    /**
     * @return void
     */
    public function install()
    {
        $this->installLocales();
    }

    /**
     * @throws PropelException
     */
    protected function installLocales()
    {
        $localeFile = fopen($this->localeFile, 'r');

        while (!feof($localeFile)) {
            $locale = trim(fgets($localeFile));

            $query = $this->localeQueryContainer->queryLocaleByName($locale);

            if (!$query->count()) {
                $entity = new SpyLocale();
                $entity->setLocaleName($locale);
                $entity->setIsActive(1);
                $entity->save();
            }
        }
    }
}
