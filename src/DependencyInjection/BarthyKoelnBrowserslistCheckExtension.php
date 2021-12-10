<?php

namespace BarthyKoeln\BrowserslistCheckBundle\DependencyInjection;

use BarthyKoeln\BrowserslistCheckBundle\Service\BrowserslistCheck;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\VarDumper\VarDumper;

class BarthyKoelnBrowserslistCheckExtension extends Extension
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $yamlLoader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $yamlLoader->load('services.yaml');

        $filePath = $container->getParameter('kernel.project_dir').'/.browserslistrc';
        if (!file_exists($filePath)) {
            return;
        }

        $parser = new BrowserslistParser();
        $parsed = $parser->parse(file_get_contents($filePath));

        $container->getDefinition(BrowserslistCheck::class)->setArgument('$browsers', $parsed);
    }
}
