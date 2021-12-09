<?php

namespace BarthyKoeln\BrowserslistCheckBundle;

use BarthyKoeln\BrowserslistCheckBundle\DependencyInjection\BarthyKoelnBrowserslistCheckExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BarthyKoelnBrowserslistCheckBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new BarthyKoelnBrowserslistCheckExtension();
    }
}
