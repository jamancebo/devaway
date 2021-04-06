<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\FindPilot;
use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\PilotToArray;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Application\Mapper\RaceAndPilotToArray;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\Controller\JwtAuthorizedController;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetRaces extends JwtAuthorizedController
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
     * @throws Exception
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

        if (!$this->isAuthorised('admin', $request)) {
            return $responseFormat->unauthorizedError();
        }

        $arrayRaces = [];
        $arrayPilot = [];

        $command = new ListRacesByCriteria(['id' => $id], ['points' => 'DESC']);

        try {
            $races = $commandBus->handle($command);
        } catch (RaceNotFound $e) {
            return $responseFormat->error($e->getMessage(), $e->getCode());
        }

        foreach ($races as $race) {
            $commandPilot = new FindPilot($race->idPilot()->value());
            try {
                $pilot = $commandBus->handle($commandPilot);
            } catch (PilotNotFound $e) {
                return $responseFormat->error($e->getMessage(), $e->getCode());
            }

            array_push($arrayPilot, $pilotDataTransformer->transform($pilot));
            array_push($arrayRaces, $dataTransformer->transform($race));
        }

        return $responseFormat->response($mapper->map($arrayRaces, $arrayPilot), 200);
    }
}
