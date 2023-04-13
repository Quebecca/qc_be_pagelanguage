<?php

defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    "@import 'EXT:qc_be_pagelanguage/Configuration/TSconfig/pageconfig.tsconfig'"
);

//Import Setup typo3 By default
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
    "@import 'EXT:qc_be_pagelanguage/Configuration/TypoScript/setup.typoscript'"
);

//Import Constant typo3 By default
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(
    "@import 'EXT:qc_be_pagelanguage/Configuration/TypoScript/constants.typoscript'"
);

/**
 * Override the original pageLayout Controller
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Backend\Controller\PageLayoutController::class] = [
    'className' => \Qc\QcBePageLanguage\Controller\PageLayoutController::class
];