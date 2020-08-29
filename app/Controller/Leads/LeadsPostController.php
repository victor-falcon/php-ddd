<?php

declare(strict_types=1);

namespace App\Controller\Leads;

use Cal\Leads\Command\CreateLeadCommand;
use Cal\Leads\Domain\Exception\DuplicatedLeadException;
use Cal\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadsPostController
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): Response
    {
        $name = $request->get('name');
        $email = $request->get('email');

        try {
            $this->commandBus->dispatch(new CreateLeadCommand($name, $email));

            return new Response(null, Response::HTTP_CREATED);
        } catch (DuplicatedLeadException $e) {
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }
    }
}
