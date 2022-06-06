<?php

// This file has been auto-generated by the Symfony Dependency Injection Component
// You can reference it in the "opcache.preload" php.ini setting on PHP >= 7.4 when preloading is desired

use Symfony\Component\DependencyInjection\Dumper\Preloader;

if (in_array(PHP_SAPI, ['cli', 'phpdbg'], true)) {
    return;
}

require dirname(__DIR__, 4).'/vendor/autoload.php';
(require __DIR__.'/Tests_AppKernelTestDebugContainer.php')->set(\ContainerQ5er7S3\Tests_AppKernelTestDebugContainer::class, null);
require __DIR__.'/ContainerQ5er7S3/getTest_ServiceContainerService.php';
require __DIR__.'/ContainerQ5er7S3/getTest_PrivateServicesLocatorService.php';
require __DIR__.'/ContainerQ5er7S3/getTest_Client_HistoryService.php';
require __DIR__.'/ContainerQ5er7S3/getTest_Client_CookiejarService.php';
require __DIR__.'/ContainerQ5er7S3/getTest_ClientService.php';
require __DIR__.'/ContainerQ5er7S3/getSession_FactoryService.php';
require __DIR__.'/ContainerQ5er7S3/getServicesResetterService.php';
require __DIR__.'/ContainerQ5er7S3/getSecrets_VaultService.php';
require __DIR__.'/ContainerQ5er7S3/getSecrets_DecryptionKeyService.php';
require __DIR__.'/ContainerQ5er7S3/getErrorHandler_ErrorRenderer_HtmlService.php';
require __DIR__.'/ContainerQ5er7S3/getErrorControllerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_FileLinkFormatterService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_Variadic_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_VariadicService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_Session_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_SessionService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_Service_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_ServiceService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_RequestAttribute_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_RequestAttributeService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_Request_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_RequestService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_NotTaggedController_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_NotTaggedControllerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_Default_InnerService.php';
require __DIR__.'/ContainerQ5er7S3/getDebug_ArgumentResolver_DefaultService.php';
require __DIR__.'/ContainerQ5er7S3/getContainer_GetenvService.php';
require __DIR__.'/ContainerQ5er7S3/getContainer_EnvVarProcessorsLocatorService.php';
require __DIR__.'/ContainerQ5er7S3/getContainer_EnvVarProcessorService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_SystemClearerService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_SystemService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_GlobalClearerService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_DefaultMarshallerService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_AppClearerService.php';
require __DIR__.'/ContainerQ5er7S3/getCache_AppService.php';
require __DIR__.'/ContainerQ5er7S3/getBrowserslistCheckExtensionService.php';
require __DIR__.'/ContainerQ5er7S3/getBrowserslistCheckService.php';
require __DIR__.'/ContainerQ5er7S3/get_ServiceLocator_Xbsa8iGService.php';
require __DIR__.'/ContainerQ5er7S3/get_Container_Private_SessionService.php';
require __DIR__.'/ContainerQ5er7S3/get_Container_Private_FilesystemService.php';
require __DIR__.'/ContainerQ5er7S3/get_Container_Private_CacheClearerService.php';

$classes = [];
$classes[] = 'Symfony\Bundle\FrameworkBundle\FrameworkBundle';
$classes[] = 'BarthyKoeln\BrowserslistCheckBundle\BarthyKoelnBrowserslistCheckBundle';
$classes[] = 'Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer';
$classes[] = 'Symfony\Component\Filesystem\Filesystem';
$classes[] = 'Symfony\Component\HttpFoundation\Session\Session';
$classes[] = 'Symfony\Component\DependencyInjection\ServiceLocator';
$classes[] = 'BarthyKoeln\BrowserslistCheckBundle\Service\BrowserslistCheck';
$classes[] = 'BarthyKoeln\BrowserslistCheckBundle\Twig\BrowserslistCheckExtension';
$classes[] = 'Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadataFactory';
$classes[] = 'Symfony\Component\Cache\Adapter\FilesystemAdapter';
$classes[] = 'Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer';
$classes[] = 'Symfony\Component\Cache\Marshaller\DefaultMarshaller';
$classes[] = 'Symfony\Component\Cache\Adapter\AdapterInterface';
$classes[] = 'Symfony\Component\Cache\Adapter\AbstractAdapter';
$classes[] = 'Symfony\Component\DependencyInjection\EnvVarProcessor';
$classes[] = 'Symfony\Component\HttpKernel\Controller\TraceableArgumentResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\TraceableValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\DefaultValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\NotTaggedControllerValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestAttributeValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ArgumentResolver\VariadicValueResolver';
$classes[] = 'Symfony\Component\HttpKernel\Controller\TraceableControllerResolver';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\DebugHandlersListener';
$classes[] = 'Symfony\Component\EventDispatcher\EventDispatcher';
$classes[] = 'Symfony\Component\HttpKernel\Debug\FileLinkFormatter';
$classes[] = 'Symfony\Component\Stopwatch\Stopwatch';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\DisallowRobotsIndexingListener';
$classes[] = 'Symfony\Component\HttpKernel\Controller\ErrorController';
$classes[] = 'Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer';
$classes[] = 'Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ErrorListener';
$classes[] = 'Symfony\Component\Runtime\Runner\Symfony\HttpKernelRunner';
$classes[] = 'Symfony\Component\Runtime\Runner\Symfony\ResponseRunner';
$classes[] = 'Symfony\Component\Runtime\SymfonyRuntime';
$classes[] = 'Symfony\Component\HttpKernel\HttpKernel';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\LocaleListener';
$classes[] = 'Symfony\Component\HttpKernel\Log\Logger';
$classes[] = 'Symfony\Component\HttpFoundation\RequestStack';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ResponseListener';
$classes[] = 'Symfony\Component\String\LazyString';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Secrets\SodiumVault';
$classes[] = 'Symfony\Component\DependencyInjection\ContainerInterface';
$classes[] = 'Symfony\Component\HttpKernel\DependencyInjection\ServicesResetter';
$classes[] = 'Symfony\Component\HttpFoundation\Session\SessionFactory';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\StreamedResponseListener';
$classes[] = 'Symfony\Bundle\FrameworkBundle\KernelBrowser';
$classes[] = 'Symfony\Component\BrowserKit\CookieJar';
$classes[] = 'Symfony\Component\BrowserKit\History';
$classes[] = 'Symfony\Bundle\FrameworkBundle\Test\TestContainer';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\SessionListener';
$classes[] = 'Symfony\Component\HttpKernel\EventListener\ValidateRequestListener';

$preloaded = Preloader::preload($classes);
