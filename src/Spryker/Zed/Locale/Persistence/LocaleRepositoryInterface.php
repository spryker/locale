<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Locale\Persistence;

use Generated\Shared\Transfer\LocaleCriteriaTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

interface LocaleRepositoryInterface
{
    /**
     * @param array<string> $localeNames
     *
     * @return array<\Generated\Shared\Transfer\LocaleTransfer>
     */
    public function getLocaleTransfersByLocaleNames(array $localeNames): array;

    /**
     * @param \Generated\Shared\Transfer\LocaleCriteriaTransfer $localeCriteriaTransfer
     *
     * @return array<\Generated\Shared\Transfer\LocaleTransfer>
     */
    public function getLocaleCollectionByCriteria(LocaleCriteriaTransfer $localeCriteriaTransfer): array;

    public function findLocaleTransferByLocaleName(string $localeName): ?LocaleTransfer;

    public function getLocalesCountByLocaleName(string $localeName): int;

    public function findLocaleByIdLocale(int $idLocale): ?LocaleTransfer;

    public function findLocaleByLocaleName(string $localeName): ?LocaleTransfer;

    /**
     * Result format:
     * [
     *     $idStore => [$localeName, ...],
     *     ...
     * ]
     *
     * @phpstan-return array<int, array<int, string>>
     *
     * @param array<int> $storeIds
     *
     * @return array<array<string>>
     */
    public function getLocaleNamesGroupedByIdStore(array $storeIds): array;

    /**
     * Result format:
     * [
     *     $idStore => $localeName,
     *     ...
     * ]
     *
     * @param array<int> $storeIds
     *
     * @return array<string>
     */
    public function getDefaultLocaleNamesIndexedByIdStore(array $storeIds): array;
}
