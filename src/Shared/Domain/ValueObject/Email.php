<?php declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
