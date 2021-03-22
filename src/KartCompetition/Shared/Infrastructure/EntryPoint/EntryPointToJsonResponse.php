<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Infrastructure\EntryPoint;

use DevAway\KartCompetition\Shared\Domain\EntryPoint\EntryPointResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class EntryPointToJsonResponse implements EntryPointResponse
{

    /**
     * @param array $entity
     * @param integer $code
     * @return JsonResponse
     */
    public function response(array $entity, int $code): JsonResponse
    {
        $jsonresponse = [
            'status' => $code,
            'data' => $entity
        ];

        return new JsonResponse($jsonresponse, $code);
    }

    /**
     * @param string $data
     * @param integer $code
     * @return JsonResponse
     */
    public function error(string $data, int $code): JsonResponse
    {
        $jsonresponse = [
            'detail' => $data,
            'status' => $code
        ];
        return new JsonResponse($jsonresponse, $code);
    }
}
