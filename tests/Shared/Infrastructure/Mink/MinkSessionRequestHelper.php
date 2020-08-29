<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Mink;

use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\DomCrawler\Crawler;

final class MinkSessionRequestHelper
{
    private MinkHelper $sessionHelper;

    public function __construct(MinkHelper $sessionHelper)
    {
        $this->sessionHelper = $sessionHelper;
    }

    public function sendRequest(string $method, string $url, array $optionalParams = []): void
    {
        $this->request($method, $url, $optionalParams);
    }

    public function sendRequestWithPyStringNode(string $method, string $url, PyStringNode $body): void
    {
        $this->request($method, $url, ['content' => $body->getRaw()]);
    }

    public function request(string $method, string $url, array $optionalParams = []): Crawler
    {
        return $this->sessionHelper->sendRequest($method, $url, $optionalParams);
    }
}
