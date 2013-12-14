<?php

use Symfony\CS\FixerInterface;

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->notName('LICENSE')
    ->notName('README.md')
    ->notName('.php_cs')
    ->notName('composer.*')
    ->notName('phpunit.xml*')
    ->notName('*.phar')
    ->exclude('vendor')
    ->exclude('examples')
    ->exclude('Symfony/CS/Tests/Fixer')
    ->notName('ElseifFixer.php')
    ->exclude('data')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->fixers(array(
        'indentation', 'linefeed', 'trailing_spaces',
        'unused_use', 'phpdoc_params', 'short_tag', 'return',
        'visibility', 'php_closing_tag', 'braces', 'extra_empty_lines',
        'function_declaration', 'include', 'controls_space', 'psr0', 'elseif',
        'eof_ending'
    ))
    ->finder($finder)
;


