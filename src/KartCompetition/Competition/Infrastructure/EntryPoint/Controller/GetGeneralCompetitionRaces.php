<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\FindPilot;
use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\CompetitionToArray;
use DevAway\KartCompetition\Competition\Application\Service\GeneralClasification;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
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
     * @param CompetitionToArray $dataTransformer
     * @return JsonResponse
     */
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        CompetitionToArray $dataTransformer
    ): JsonResponse {

        $idPilotArray = [];
        $racesPilot = [];
        $clasifications = [];
        $arrayClasificaciones = [];
        $command = new ListRacesByCriteria([], ["idPilot" => "ASC"]);
        $service = new GeneralClasification();

        try {
            $races = $commandBus->handle($command);
        } catch (RaceNotFound $e) {
            return $responseFormat->error($e->getMessage(), $e->getCode());
        }

        $numRaces = sizeof($races);
        foreach ($races as $key => $race) {
            if ($key == 0) {
                array_push($idPilotArray, $race->idPilot()->value());
            }

            if (!in_array($race->idPilot()->value(), $idPilotArray) || $key === $numRaces - 1) {
                array_push($idPilotArray, $race->idPilot()->value());
                $clasifications[] = $service->execute($racesPilot, $race->idPilot()->value());
                unset($racesPilot);
            }
            $racesPilot[] = $race;
        }

        foreach ($clasifications as $key => $clasification) {
            $command = new FindPilot($clasification->idPilot()->value());
            try {
                $pilot = $commandBus->handle($command);
                $clasification->updatePilotName($pilot->name());
            } catch (PilotNotFound $e) {
                return $responseFormat->error($e->getMessage(), $e->getCode());
            }
            array_push($arrayClasificaciones, $dataTransformer->transform($clasification));
        }

        usort($arrayClasificaciones, function ($a, $b) {
            if ($a['points'] == $b['points']) {
                return 0;
            }
            return ($a['points'] < $b['points']) ? 1 : -1;
        });

        return $responseFormat->response($arrayClasificaciones, 200);
    }
}
