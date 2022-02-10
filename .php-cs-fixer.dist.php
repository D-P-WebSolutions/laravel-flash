<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__.'/config/',
        __DIR__.'/helpers/',
        __DIR__.'/src/',
        __DIR__.'/tests/',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer'                            => true,
        'phpdoc_no_empty_return'                 => false,
        'strict_param'                           => true,
        'array_syntax'                           => ['syntax' => 'short'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'php_unit_method_casing'                 => ['case' => 'snake_case']
    ])
    ->setFinder($finder);
