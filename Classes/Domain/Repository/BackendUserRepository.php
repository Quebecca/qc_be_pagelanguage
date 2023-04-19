<?php

declare(strict_types=1);
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Qc\QcBePageLanguage\Domain\Repository;

use Doctrine\DBAL\DBALException;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Class BeUsersRepository
 *
 * @package Qc\QcBePageLanguage
 */
class BackendUserRepository extends  Repository{

    /**
     * @throws DBALException
     */
    public function updateBackendUserPageLanguage($be_user, $id_lang){
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');
        $queryBuilder
            ->update('be_users')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($be_user, \PDO::PARAM_INT))
            )
            ->set('page_mod_language', $id_lang)
            ->executeStatement();
    }
}