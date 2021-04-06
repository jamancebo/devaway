<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\CreatePilot;
use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\KartCompetition\Competition\Application\Command\FindPilot;
use DevAway\KartCompetition\Competition\Application\Command\ListPilotsByCriteria;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Shared\Infrastructure\EntryPoint\EntryPointToJsonResponse;
use Exception;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostRaces
{
    public function __invoke(
        Request $request,
        CommandBus $commandBus,
        EntryPointToJsonResponse $responseFormat,
        RacesToArray $dataTransformer
    ): JsonResponse {

        $param = json_decode($request->getContent(), true);

        foreach ($param as $params) {
            if (!$this->paramsAreValid($params)) {
                return $responseFormat->error(
                    'Valid data not provided in request body',
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $getPilot = new FindPilot($params["_id"]);
            try {
                $pilot = $commandBus->handle($getPilot);
            } catch (PilotNotFound $e) {
                if (!isset($pilot)) {
                    $createPilot = new CreatePilot(
                        $params["_id"],
                        $params["picture"],
                        $params["team"],
                        $params["name"],
                        $params["age"]
                    );

                    try {
                        $commandBus->handle($createPilot);
                    } catch (Exception $e) { // @codeCoverageIgnore
                        return $responseFormat->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR); // @codeCoverageIgnore
                    }
                }
            }

            $commandRace = new CreateRace(
                $params['_id'],
                $params["races"]
            );

            try {
                $commandBus->handle($commandRace);
            } catch (Exception $e) { // @codeCoverageIgnore
                return $responseFormat->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR); // @codeCoverageIgnore
            }
        }
        return $responseFormat->response(["data" => "Created Races OK"], Response::HTTP_CREATED);
    }

    /**
     * @param array|null $params
     * @return bool
     */
    private function paramsAreValid(?array $params): bool
    {
        if (!is_array($params)) {
            return false;
        }

        $requiredParams = [
            '_id' => fn ($idPilot) => is_string($idPilot),
            'picture' => fn ($photo) => is_string($photo),
            'age' => fn ($age) => is_int($age),
            'name' => fn ($namePilot) => is_string($namePilot),
            'team' => fn ($team) => is_string($team),
            'races' => fn ($races) => is_array($races)
        ];

        foreach ($requiredParams as $paramName => $isValidParam) {
            if (!array_key_exists($paramName, $params)) {
                return false;
            }

            if (!$isValidParam($params[$paramName])) {
                return false;
            }
        }

        return true;
    }
}
