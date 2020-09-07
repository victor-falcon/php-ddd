<?php

declare(strict_types=1);

namespace Cal\Leads\Domain\Exception;

class DuplicatedLeadException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Duplicated lead', 0, null);
    }
}
