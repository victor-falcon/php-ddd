<?php

declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

class NullableStringValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
