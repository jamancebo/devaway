<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetRaces
{
    /**
     * @param string $id
     * @param Request $request
     * @param CommandBus $commandBus
     * @param EntryPointToJsonResponse $responseFormat
     * @param RacesToArray $dataTransformer
     * @return JsonResponse
     */
    public function __invoke(
        string $id,
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        RacesToArray $dataTransformer
    ): JsonResponse {

        $filters = ['id' => $id];

        $command = new ListRacesByCriteria($filters);

        try {
            $races = $commandBus->handle($command);
        } catch (RaceNotFound $e) {
            return $responseFormat->error($e->getMessage(), $e->getCode());
        }

        $arrayRaces = [];
        foreach ($races as $race) {
            array_push($arrayRaces, $dataTransformer->transform($race));
        }


        return $responseFormat->response($arrayRaces, 200);
    }
}
