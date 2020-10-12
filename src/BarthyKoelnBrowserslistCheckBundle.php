<?php
/**
 * Created by PhpStorm.
 * User: bbonhomme
 * Date: 16.10.18
 * Time: 17:59.
 */

namespace BarthyKoeln\BrowserslistCheckBundle;

use BarthyKoeln\BrowserslistCheckBundle\DependencyInjection\BarthyKoelnBrowserslistCheckExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BarthyKoelnBrowserslistCheckBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new BarthyKoelnBrowserslistCheckExtension();
    }
}
