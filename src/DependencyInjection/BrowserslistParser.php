<?php

namespace BarthyKoeln\BrowserslistCheckBundle\DependencyInjection;

class BrowserslistParser
{
    public function parse(string $fileContents): array
    {
        $lines   = explode(PHP_EOL, $fileContents);
        $configs = [];

        $lines = array_filter($lines);

        foreach ($lines as $line) {
            if (str_starts_with($line, '[') && str_ends_with($line, ']')) {
                if ('[modern]' !== $line) {
                    return $configs;
                }

                continue;
            }

            $params              = explode(' >= ', $line);
            $configs[$params[0]] = floatval($params[1]);
        }

        return $configs;
    }
}
