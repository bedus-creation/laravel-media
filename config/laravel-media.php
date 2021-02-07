<?php
use Aammui\LaravelMedia\Enum\Extension;
use Aammui\LaravelMedia\Enum\Responsive;

return [
    "extension"  => [
        Extension::IMAGE    => "jpg,png,gif,jpeg",
        Extension::DOCUMENT => "pdf,doc,xls,docx,xlsx",
    ],
    'responsive' => [
        Responsive::SM => [
            'w' => 50,
            'h' => 50,
        ],
        Responsive::MD => [
            'w' => 150,
            'h' => 150,
        ],
        Responsive::LG => [
            'w' => 600, // Can define either height or width only.
        ],
    ],
    'optimize'   => true,
];
