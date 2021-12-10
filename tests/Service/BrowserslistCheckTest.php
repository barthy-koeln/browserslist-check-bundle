<?php

namespace Tests\Service;

use BarthyKoeln\BeautifySpecify\Specify;
use BarthyKoeln\BrowserslistCheckBundle\Service\BrowserslistCheck;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

class BrowserslistCheckTest extends KernelTestCase
{
    use Specify;

    private BrowserslistCheck $service;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $service = $kernel->getContainer()->get(BrowserslistCheck::class);
        if ($service instanceof BrowserslistCheck) {
            $this->service = $service;
        }

        parent::setUp();
    }

    public function testService()
    {
        $this->describe(
            BrowserslistCheck::class,
            function () {
                $this->it(
                    'has a list of browsers.',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $property = $reflection->getProperty('browsers');

                        $property->setAccessible(true);
                        $browsers = $property->getValue($this->service);

                        $this->assertNotEmpty($browsers);
                    }
                );

                $this->it(
                    'does not parse anything when it is not called',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $browser = $reflection->getProperty('browser');
                        $version = $reflection->getProperty('version');

                        $browser->setAccessible(true);
                        $version->setAccessible(true);
                        $browser = $browser->getValue($this->service);
                        $version = $version->getValue($this->service);

                        $this->assertNull($browser);
                        $this->assertNull($version);
                    }
                );

                $this->it(
                    'correctly matches versions',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $browsers = $reflection->getProperty('browsers');

                        $method = $reflection->getMethod('matchVersion');

                        $browsers->setAccessible(true);
                        $method->setAccessible(true);

                        $browsers->setValue($this->service, ['Chrome' => 98.0]);

                        $tests = [
                            ['Chrome', 98.0, true],
                            ['Chrome', 98.1, true],
                            ['Chrome', 100, true],
                            ['Chrome', 97.999, false],
                            ['Chrome', -3, false],
                            ['Firefox', -3, false],
                            ['Firefox', 98.0, false],
                        ];

                        foreach ($tests as $test) {
                            $this->assertEquals($test[2], $method->invoke($this->service, $test[0], $test[1]));
                        }
                    }
                );

                $this->it(
                    'correctly parses the user agent',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $requestProperty = $reflection->getProperty('request');
                        $browsers = $reflection->getProperty('browsers');
                        $browser = $reflection->getProperty('browser');
                        $version = $reflection->getProperty('version');

                        $browsers->setAccessible(true);
                        $requestProperty->setAccessible(true);
                        $browser->setAccessible(true);
                        $version->setAccessible(true);

                        $request = new Request();

                        $request->headers->set(
                            'User-Agent',
                            '',
                        );

                        $browsers->setValue($this->service, ['Chrome' => 45.0]);
                        $requestProperty->setValue($this->service, $request);

                        $this->assertFalse($this->service->isModern());

                        $request->headers->set(
                            'User-Agent',
                            'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
                            true
                        );

                        $browsers->setValue($this->service, ['Chrome' => 45.0]);
                        $browser->setValue($this->service, null);
                        $version->setValue($this->service, null);
                        $requestProperty->setValue($this->service, $request);

                        $this->assertTrue($this->service->isModern());
                    }
                );

                $this->it(
                    'graciously handles parsing errors',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $requestProperty = $reflection->getProperty('request');
                        $browsers = $reflection->getProperty('browsers');
                        $browser = $reflection->getProperty('browser');
                        $version = $reflection->getProperty('version');

                        $browsers->setAccessible(true);
                        $browser->setAccessible(true);
                        $version->setAccessible(true);
                        $requestProperty->setAccessible(true);
                        $request = new Request();

                        $browsers->setValue($this->service, ['Chrome' => 45.0]);
                        $browser->setValue($this->service, null);
                        $version->setValue($this->service, null);
                        $requestProperty->setValue($this->service, $request);

                        $this->assertFalse($this->service->isModern());
                    }
                );

                $this->it(
                    'correctly checks if the browser is modern',
                    function () {
                        $reflection = new ReflectionClass($this->service);
                        $browsers = $reflection->getProperty('browsers');
                        $browser = $reflection->getProperty('browser');
                        $version = $reflection->getProperty('version');

                        $browsers->setAccessible(true);
                        $browser->setAccessible(true);
                        $version->setAccessible(true);

                        $browsers->setValue($this->service, ['Chrome' => 98.0]);

                        $this->assertTrue($this->service->isModern('Chrome', 98.0));
                        $this->assertFalse($this->service->isModern('Chrome', 94.0));

                        $browser->setValue($this->service, 'Chrome');
                        $version->setValue($this->service, 98.0);

                        $this->assertTrue($this->service->isModern());
                    }
                );
            }
        );
    }
}
