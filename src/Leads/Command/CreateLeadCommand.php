<?php declare(strict_types=1);

namespace Cal\Leads\Command;

use Cal\Shared\Domain\Bus\Command\Command;

final class CreateLeadCommand implements Command
{
    private ?string $name;
    private string $email;

    public function __construct(?string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}
