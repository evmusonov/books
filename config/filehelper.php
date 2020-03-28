<?php

return [
    'documentExtensions' => ['pdf', 'docx', 'xslx'],
    'imageExtensions'    => ['jpeg', 'png', 'gif'],
    'pathToStorage'      => $_SERVER['DOCUMENT_ROOT'] . '/../storage',
    'versions' => [
        '300x400' => [
            'width'   => 300,
            'height'  => 400,
            'quality' => 80
        ],
        '200x200' => [
            'width'   => 200,
            'height'  => 200,
            'quality' => 100
        ],
        'thumb' => [
            'width'   => 300,
            'height'  => 300,
            'quality' => 80
        ],
    ]
];
