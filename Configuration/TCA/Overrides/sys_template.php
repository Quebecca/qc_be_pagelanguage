<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3') || die();

ExtensionManagementUtility::addStaticFile('qc_be_pagelanguage', 'Configuration/TypoScript', 'Qc Backend page language');
