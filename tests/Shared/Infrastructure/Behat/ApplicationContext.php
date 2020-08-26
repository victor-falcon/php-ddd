<?php declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Behat;

use App\Tests\Shared\Infrastructure\Mink\MinkHelper;
use App\Tests\Shared\Infrastructure\Mink\MinkSessionRequestHelper;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use RuntimeException;

final class ApplicationContext extends RawMinkContext
{
    private MinkHelper $sessionHelper;
    private Session $minkSession;
    private MinkSessionRequestHelper $request;

    public function __construct(Session $session)
    {
        $this->minkSession = $session;
        $this->sessionHelper = new MinkHelper($this->minkSession);
        $this->request = new MinkSessionRequestHelper(new MinkHelper($session));
    }

    /**
     * @Given I make a :method request to :path
     */
    public function iMakeARequestTo(string $path, string $method): void
    {
        $this->request->sendRequest($method, $this->locatePath($path));
    }

    /**
     * @Given I make a :method request to :path with body
     */
    public function iMakeARequestToWithBody(string $path, string $method, PyStringNode $body)
    {
        $this->request->sendRequestWithPyStringNode($method, $this->locatePath($path), $body);
    }

    /**
     * @Then the response content should be
     */
    public function theResponseShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeJson($expectedResponse->getRaw());
        $actual = $this->sanitizeJson($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    /**
     * @Then the response content should be empty
     */
    public function theResponseContentShouldBeEmpty()
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (false === empty($actual)) {
            throw new RuntimeException(
                sprintf("The outputs it's not empty!\n\n-- Actual:\n%s", $actual)
            );
        }
    }

    /**
     * @Then the response status code should be :code
     */
    public function theResponseStatusCodeShouldBe(int $code)
    {
        if ($code !== $this->minkSession->getStatusCode()) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->minkSession->getStatusCode(),
                    $code
                )
            );
        }
    }

    private function sanitizeJson(string $json)
    {
        return json_encode(json_decode(trim($json), true));
    }
}
