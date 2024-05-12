<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Rest-Api',
    'description' => 'Extending extension for EXT:nnrestapi',
    'category' => 'frontend',
    'author' => 'David Bruchmann',
    'author_email' => 'david.bruchmann@gmail.com',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.9.99',
            'nnhelpers' => '2.0.0-0.0.0',
            'nnrestapi' => '2.0.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
