<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

use Cal\Shared\Domain\Exception\InvalidJsonException;

class JsonValue
{
    protected string $value;

    public function __construct(array $value)
    {
        $this->value = json_encode($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function asArray(): array
    {
        return json_decode($this->value, true);
    }

    private function throwIsInvalid(string $value)
    {
        $valid = (json_decode($value , true) == NULL) ? false : true ;

        if (false === $valid) {
            throw new InvalidJsonException($value);
        }
    }
}