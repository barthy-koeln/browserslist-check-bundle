<?php

namespace Tests\DependencyInjection;

use BarthyKoeln\BeautifySpecify\Specify;
use BarthyKoeln\BrowserslistCheckBundle\DependencyInjection\BrowserslistParser;
use PHPUnit\Framework\TestCase;

class BrowserslistParserTest extends TestCase
{
    use Specify;

    private BrowserslistParser $parser;
    private string $modernOnly;
    private string $regular;

    public function setUp(): void
    {
        $modernOnly   = __DIR__.'/../.browserslistrc-modernOnly';
        $regular      = __DIR__.'/../.browserslistrc';
        $this->parser = new BrowserslistParser();

        $this->modernOnly = file_get_contents($modernOnly);
        $this->regular    = file_get_contents($regular);

        parent::setUp();
    }

    public function testParsing()
    {
        $this->describe(
            BrowserslistParser::class,
            function () {
                $this->it(
                    'gets an array of Browsers',
                    function () {
                        $result = $this->parser->parse($this->modernOnly);

                        $this->assertEquals(8, count($result));
                    }
                );

                $this->it(
                    'does not parse the environment names',
                    function () {
                        $result = $this->parser->parse($this->modernOnly);

                        foreach ($result as $name => $version) {
                            $this->assertStringStartsNotWith('[', $name);
                        }
                    }
                );

                $this->it(
                    'parses all lines to floats',
                    function () {
                        $result = $this->parser->parse($this->modernOnly);

                        foreach ($result as $version) {
                            $this->assertIsFloat($version);
                        }
                    }
                );

                $this->it(
                    'does not parse legacy versions',
                    function () {
                        $result = $this->parser->parse($this->regular);

                        $this->assertEquals(8, count($result));
                    }
                );
            }
        );
    }
}
