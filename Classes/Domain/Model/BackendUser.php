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

namespace Qc\QcBePageLanguage\Domain\Model;

/**
 * Class BackendUser
 *
 * @package Qc\QcBePageLanguage
 */
class BackendUser extends \TYPO3\CMS\Beuser\Domain\Model\BackendUser
{

    /**
     * Backend user module page language
     *
     * @var string $pageModLanguage
     */
    protected string $pageModLanguage;

    /**
     * @return string
     */
    public function getPageModLanguage(): string
    {
        return $this->pageModLanguage;
    }

    /**
     * @param string $pageModLanguage
     *
     * @return void
     */
    public function setPageModLanguage(string $pageModLanguage)
    {
        $this->pageModLanguage = $pageModLanguage;
    }

}
