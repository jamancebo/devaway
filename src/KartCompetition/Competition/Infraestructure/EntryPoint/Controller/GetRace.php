<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infraestructure\EntryPoint\Controller;

use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetRace
{
    /**
     * @param Request $request
     * @param CommandBus $commandBus
     * @return JsonResponse
     */
    public function __invoke(Request $request, CommandBus $commandBus)
    {
        return new JsonResponse([], 200);
    }
}
