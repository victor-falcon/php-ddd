<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

use Cal\Shared\Domain\Exception\InvalidJsonException;
use Cal\Shared\Domain\Utils;

class JsonValue
{
    protected string $value;

    public function __construct(array $value)
    {
        $this->value = Utils::jsonEncode($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function asArray(): array
    {
        return Utils::jsonDecode($this->value);
    }

    private function throwIsInvalid(string $value)
    {
        $valid = (Utils::jsonDecode($value) == null) ? false : true;

        if (false === $valid) {
            throw new InvalidJsonException($value);
        }
    }
}
