<?php declare(strict_types=1);

namespace Cal\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as BaseUuid;

class Uuid
{
    protected string $uuid;

    public function __construct(string $uuid)
    {
        throw_unless(
            $this->isValidUuid($uuid),
            new \InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $uuid))
        );

        $this->uuid = $uuid;
    }

    public static function generate(): string
    {
        return BaseUuid::uuid4()->toString();
    }

    public function value(): string
    {
        return $this->uuid;
    }

    private function isValidUuid(string $uuid): bool
    {
        return BaseUuid::isValid($uuid);
    }
}