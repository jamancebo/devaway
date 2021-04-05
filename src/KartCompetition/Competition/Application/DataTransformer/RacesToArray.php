<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;

class RacesToArray
{
    /**
     * @param Race $race
     * @return array
     */
    public function transform(Race $race): array
    {
        return [
            'id' => $race->id()->value(),
            'name' => $race->name()->value(),
            'idPilot' => $race->idPilot()->value(),
            'laps' => $race->laps()->values(),
            'bestTime' => $race->bestTime()->value(),
            'totalTime' => $race->totalTime()->value(),
            'points' => $race->points()->value()
        ];
    }

    /**
     * @param array $data
     * @return Race
     */
    public function reverseTransform(array $data): Race
    {
        return Race::instantiate(
            Id::fromString($data['id']),
            RaceName::fromString($data['name']),
            IdPilot::fromString($data['idPilot']),
            Laps::fromValues($data['laps']),
            Time::fromString($data['bestTime']),
            Time::fromString($data['totalTime']),
            Points::fromInt($data['points'])
        );
    }
}
