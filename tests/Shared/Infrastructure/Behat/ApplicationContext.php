<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use Behat\Gherkin\Node\PyStringNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

final class ApplicationContext extends RawMinkContext
{
    private KernelInterface $kernel;
    private ?Response $response = null;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @When we make a :type request to :path
     */
    public function aDemoScenarioSendsARequestTo(string $path, string $type): void
    {
        $this->response = $this->kernel->handle(Request::create($path, $type));
    }

    /**
     * @Then the response content should be
     */
    public function theResponseShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeJson($expectedResponse->getRaw());
        $actual = $this->sanitizeJson($this->response->getContent());

        if ($expected !== $actual) {
            throw new \RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    private function sanitizeJson(string $json)
    {
        return json_encode(json_decode(trim($json), true));
    }
}
