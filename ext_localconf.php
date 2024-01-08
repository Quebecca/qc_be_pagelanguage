<?php

use Qc\QcBePageLanguage\Controller\PageCalloutsXclass;
use Sypets\PageCallouts\Xclass\PageLayoutControllerWithCallouts;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Controller\PageLayoutController;

defined('TYPO3') || die();

//Import Setup typo3 By default
ExtensionManagementUtility::addTypoScriptSetup(
    "@import 'EXT:qc_be_pagelanguage/Configuration/TypoScript/setup.typoscript'"
);

//Import Constant typo3 By default
ExtensionManagementUtility::addTypoScriptConstants(
    "@import 'EXT:qc_be_pagelanguage/Configuration/TypoScript/constants.typoscript'"
);

//Import TsConfig
$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 12) {
    ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:qc_be_pagelanguage/Configuration/page.tsconfig"'
    );
}

$pageCalloutsVersion = ExtensionManagementUtility::getExtensionVersion("page_callouts");

if($pageCalloutsVersion !== ''){
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][PageLayoutControllerWithCallouts::class] = [
        'className' => PageCalloutsXclass::class
    ];
}
else {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][PageLayoutController::class] = [
        'className' => \Qc\QcBePageLanguage\Controller\PageLayoutController::class
    ];
}
