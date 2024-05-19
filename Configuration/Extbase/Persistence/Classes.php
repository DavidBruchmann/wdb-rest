<?php

declare(strict_types=1);

return [
    \WDB\WdbRest\Domain\Model\Category::class => [
        'tableName' => 'sys_category',
    ],
    \WDB\WdbRest\Domain\Model\Content::class => [
        'tableName' => 'tt_content',
        'properties' => [
            'cType' => [
                'fieldName' => 'CType',
            ],
        ],
    ],
    \WDB\WdbRest\Domain\Model\Page::class => [
        'tableName' => 'pages',
    ],
];