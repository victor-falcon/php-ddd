<?php declare(strict_types=1);

namespace App\Controller\Leads;

use Cal\Leads\Command\CreateLeadJob;
use Cal\Leads\Command\CreateLeadJobHandler;
use Cal\Leads\Domain\Exception\DuplicatedLeadException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadsPostController
{
    private CreateLeadJobHandler $handler;

    public function __construct(CreateLeadJobHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): Response
    {
        $name = $request->get('name');
        $email = $request->get('email');

        try {
            ($this->handler)(new CreateLeadJob($name, $email));
            return new Response(null, Response::HTTP_CREATED);
        } catch (DuplicatedLeadException $e) {
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }
    }
}