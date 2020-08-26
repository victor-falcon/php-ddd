<?php declare(strict_types=1);

namespace App\Controller\Leads;

use Cal\Leads\Command\CreateLeadJob;
use Cal\Leads\Command\CreateLeadJobHandler;
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

        ($this->handler)(new CreateLeadJob($name, $email));

        return new Response(null, Response::HTTP_CREATED);
    }
}