<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Qc Backend Page Language',
    'description' => 'This extension brings back the behaviour from TYPO3 v10 that language selection is kept while browsing the Pagetree in Page module with option Languages instead of Column.',
    'category' => 'be',
    'author' => 'Quebec.ca',
    'author_company' => 'Québec',
    'state' => 'beta',
    'version' => '1.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.5.0',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Qc\\QcBePageLanguage\\' => 'Classes/',
        ],
    ],
];
