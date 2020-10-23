<?php

namespace BarthyKoeln\BrowserslistCheckBundle\Service;

use donatj\UserAgent\UserAgentParser;

class BrowserslistCheck
{

    private array $browsers;
    private ?string $browser = null;
    private ?float $version = null;

    public function __construct(array $browsers)
    {
        $this->browsers = $browsers;
    }

    public function isModern(?string $browser = null, ?float $version = null): bool
    {
        if (null === $browser && null === $this->browser) {
            $parser = new UserAgentParser();

            $userAgent = $parser->parse();

            $this->browser = $userAgent->browser();
            $this->version = floatval($userAgent->browserVersion());

            if (null === $this->browser || null === $this->version) {
                return false;
            }
        }

        return $this->matchVersion($browser ?? $this->browser, $version ?? $this->version);
    }

    private function matchVersion(string $browser, float $version): bool
    {
        if (array_key_exists($browser, $this->browsers)) {
            return $version >= $this->browsers[$browser];
        }

        return false;
    }
}
