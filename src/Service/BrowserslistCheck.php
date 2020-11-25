<?php

namespace BarthyKoeln\BrowserslistCheckBundle\Service;

use donatj\UserAgent\UserAgentParser;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class BrowserslistCheck
{
    private array $browsers;

    private ?string $browser = null;

    private ?float $version = null;

    private ?Request $request;

    public function __construct(array $browsers, RequestStack $requestStack)
    {
        $this->request  = $requestStack->getMasterRequest();
        $this->browsers = $browsers;
    }

    public function isModern(?string $browser = null, ?float $version = null): bool
    {
        if (null === $browser && null === $this->browser) {
            $parser = new UserAgentParser();

            try {
                $userAgent = $parser->parse($this->request->headers->get('User-Agent'));
            } catch (InvalidArgumentException $exception) {
                return false;
            }

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
