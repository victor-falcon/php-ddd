<?php declare(strict_types=1);

namespace App\Controller\Leads;

use Symfony\Component\HttpFoundation\JsonResponse;

class LeadsPostController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            'lead' => true,
        ]);
    }
}