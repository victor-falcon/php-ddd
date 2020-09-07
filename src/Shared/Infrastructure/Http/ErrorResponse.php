<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(\Exception $exception, int $status = 200)
    {
        parent::__construct(
            [
                'error' => true,
                'message' => $exception->getMessage(),
            ],
            $status,
            [],
            false
        );
    }
}
