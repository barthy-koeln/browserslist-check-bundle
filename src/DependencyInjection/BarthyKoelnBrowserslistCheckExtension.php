<?php

namespace BarthyKoeln\BrowserslistCheckBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BarthyKoelnBrowserslistCheckExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
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

        $parser = new BrowsersListParser();
        $parsed = $parser->parse(file_get_contents($filePath));

        $container->getDefinition(BrowserslistCheck::class)->setArgument('$browsers', $parsed);
    }
}
