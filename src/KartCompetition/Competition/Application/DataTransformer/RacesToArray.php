<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
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
            'time' => $race->time()->value(),
            'points' => $race->points()->value(),
            'name' => $race->name()->value(),
            'idPilot' => $race->idPilot()->value(),
            'bestTime' => $race->bestTime()->value()
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
            Time::fromString($data['time']),
            Points::fromInt($data['points']),
            RaceName::fromString($data['name']),
            IdPilot::fromString($data['idPilot']),
            Time::fromString($data['bestTime'])
        );
    }
}
