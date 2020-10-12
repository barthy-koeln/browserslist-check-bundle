<?php

namespace BarthyKoeln\BrowserslistCheckBundle\Twig;

use BarthyKoeln\BrowserslistCheckBundle\DependencyInjection\BrowserslistCheck;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MultiEncoresExtension extends AbstractExtension
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

    public function isModernBrowser()
    {
        return $this->browsersListConfig->isModern();
    }
}
