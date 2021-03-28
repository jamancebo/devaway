<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
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

        $params = json_decode($request->getContent(), true);

        if (!$this->paramsAreValid($params)) {
            return $responseFormat->error(
                'Valid data not provided in request body',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $command = new CreateRace(
            $params['name'],
            $params['idPilot'],
            $params['laps']
        );

        try {
            $race = $commandBus->handle($command);
        } catch (Exception $e) { // @codeCoverageIgnore
            return $responseFormat->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR); // @codeCoverageIgnore
        }

        return $responseFormat->response($dataTransformer->transform($race), Response::HTTP_CREATED);
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
            'name' => fn ($name) => is_string($name),
            'idPilot' => fn ($idPilot) => is_string($idPilot),
            'laps' => fn ($laps) => is_array($laps)
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
