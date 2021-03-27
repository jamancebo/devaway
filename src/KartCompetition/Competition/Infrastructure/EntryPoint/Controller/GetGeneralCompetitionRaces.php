<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\ListPilotsByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetGeneralCompetitionRaces
{
    /**
     * @param Request $request
     * @param CommandBus $commandBus
     * @param EntryPointToJsonResponse $responseFormat
     * @param RacesToArray $dataTransformer
     */
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        RacesToArray $dataTransformer
    ): JsonResponse {
        $orders = ["points" => 'DESC'];
        $command = new ListPilotsByCriteria([], $orders);

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
