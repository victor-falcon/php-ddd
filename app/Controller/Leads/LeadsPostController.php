<?php declare(strict_types=1);

namespace App\Controller\Leads;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadsPostController
{
    public function __invoke(Request $request): Response
    {
        $name = $request->get('name');
        $email = $request->get('email');

        return new Response(null, Response::HTTP_CREATED);
    }
}