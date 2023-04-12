<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Qc Backend page Language',
    'description' => 'This extension allow you to set the default key language for page context menu',
    'category' => 'be',
    'author' => 'Quebec.ca',
    'author_company' => 'Québec',
    'state' => 'alpha',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.0.0-11.5.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Qc\\QcBePagelanguage\\' => 'Classes/',
        ],
    ],
];
