<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src');

return (new PhpCsFixer\Config())
    ->setRules(
        [
            '@Symfony'               => true,
            'array_syntax'           => ['syntax' => 'short'],
            'phpdoc_to_comment'      => false,
            'binary_operator_spaces' => [
                'default'   => 'align_single_space_minimal',
                'operators' => [
                    '??'  => 'single_space',
                    '&&'  => 'single_space',
                    '||'  => 'single_space',
                    '=='  => 'single_space',
                    '===' => 'single_space',
                    '!='  => 'single_space',
                    '!==' => 'single_space',
                    '=>'  => 'align_single_space',
                ],
            ],
        ]
    )
    ->setFinder($finder);
