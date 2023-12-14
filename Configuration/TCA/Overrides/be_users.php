<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$ll = 'LLL:EXT:qc_be_pagelanguage/Resources/Private/Language/locallang_db.xlf:';

$customColumn = [
    'page_mod_language' => [
        'label' => $ll.'beUsers.page_mod_language',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'readOnly' => true,
        ],
    ],
];

/**
 * ADD EXTEND COLUMN TO Be Users table
 */
ExtensionManagementUtility::addTCAcolumns(
    'be_users',
    $customColumn
);


