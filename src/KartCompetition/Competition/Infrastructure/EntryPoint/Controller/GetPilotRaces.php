<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\ListPilotsByCriteria;
use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\PilotToArray;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Application\Mapper\RaceAndPilotToArray;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetPilotRaces
{
    /**
     * @param string $id
     * @param Request $request
     * @param CommandBus $commandBus
     * @param EntryPointToJsonResponse $responseFormat
     * @param RacesToArray $dataTransformer
     * @param PilotToArray $pilotDataTransformer
     * @param RaceAndPilotToArray $mapper
     * @return JsonResponse
     */
    public function __invoke(
        string $id,
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        RacesToArray $dataTransformer,
        PilotToArray $pilotDataTransformer,
        RaceAndPilotToArray $mapper
    ): JsonResponse {

        $arrayRaces = [];
        $command = new ListPilotsByCriteria(['id' => $id]);

        try {
            $pilots = $commandBus->handle($command);
        } catch (PilotNotFound $e) {
            return $responseFormat->error($e->getMessage(), $e->getCode());
        }

        $command = new ListRacesByCriteria(['idPilot' => $id], ['name' => 'ASC']);

        try {
            $races = $commandBus->handle($command);
        } catch (RaceNotFound $e) {
            return $responseFormat->error($e->getMessage(), $e->getCode());
        }

        foreach ($races as $race) {
            array_push($arrayRaces, $dataTransformer->transform($race));
        }

        return $responseFormat->response($arrayRaces, 200);
    }
}
