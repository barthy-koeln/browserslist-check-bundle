<?php

namespace BarthyKoeln\BrowserslistCheckBundle\Twig;

use BarthyKoeln\BrowserslistCheckBundle\Service\BrowserslistCheck;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BrowserslistCheckExtension extends AbstractExtension
{
    private BrowserslistCheck $browsersListConfig;

    public function __construct(BrowserslistCheck $browsersListConfig)
    {
        $this->browsersListConfig = $browsersListConfig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_modern_browser', [$this, 'isModernBrowser']),
        ];
    }

    public function isModernBrowser(): bool
    {
        return $this->browsersListConfig->isModern();
    }
}
