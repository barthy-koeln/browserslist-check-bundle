<?php

namespace BarthyKoeln\BrowserslistCheckBundle\Service;

use donatj\UserAgent\Browsers;
use donatj\UserAgent\UserAgentParser;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;

class BrowserslistCheck
{
    /**
     * Bots and name mismatch between Broswerslist and User-Agent
     */
    const SPECIAL_BROWSERS_MAP = [
        Browsers::ANDROID_BROWSER    => 'Android',
        Browsers::BLACKBERRY_BROWSER => 'BlackBerry',
        Browsers::GOOGLEBOT          => 'Chrome',
        Browsers::GOOGLEBOT_IMAGE    => 'Chrome',
        Browsers::GOOGLEBOT_VIDEO    => 'Chrome',
        Browsers::BINGBOT            => 'Edge',
    ];
    private array $browsers;
    private ?string $browser = null;
    private ?float $version = null;
    private ?string $userAgentHeader = null;

    public function __construct(array $browsers, RequestStack $requestStack)
    {
        $mainRequest = $requestStack->getMainRequest();

        if ($mainRequest) {
            $this->userAgentHeader = $mainRequest->headers->get('User-Agent');
        }

        $this->browsers = $browsers;
    }

    public function isModern(?string $browser = null, ?float $version = null): bool
    {
        if (null === $browser && null === $this->browser) {
            $parser = new UserAgentParser();

            try {
                $userAgent = $parser->parse($this->userAgentHeader);
            } catch (InvalidArgumentException $exception) {
                return false;
            }

            $this->browser = $userAgent->browser();
            $this->version = floatval($userAgent->browserVersion());

            if (null === $this->browser) {
                return false;
            }
        }

        $browserToCheck = $browser ?? $this->browser;
        if (array_key_exists($browserToCheck, self::SPECIAL_BROWSERS_MAP)) {
            $browserToCheck = self::SPECIAL_BROWSERS_MAP[$browserToCheck];
        }

        return $this->matchVersion($browserToCheck, $version ?? $this->version);
    }

    private function matchVersion(string $browser, float $version): bool
    {
        if (array_key_exists($browser, $this->browsers)) {
            return $version >= $this->browsers[$browser];
        }

        return false;
    }
}
