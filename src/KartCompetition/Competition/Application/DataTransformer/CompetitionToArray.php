<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Domain\Entity\Clasification;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;

class CompetitionToArray
{
    /**
     * @param Clasification $clasification
     * @return array
     */
    public function transform(Clasification $clasification): array
    {
        return [
            'raceName' => $clasification->raceName() ? $clasification->raceName()->value() : null,
            'idPilot' => $clasification->idPilot()->value(),
            'pilotName' => $clasification->pilotName()->value(),
            'bestTime' => $clasification->bestTime() ? $clasification->bestTime()->value() : null,
            'totalTime' => $clasification->totalTime()->value(),
            'points' => $clasification->points()->value()
        ];
    }

    /**
     * @param array $data
     * @return Clasification
     */
    public function reverseTransform(array $data): Clasification
    {
        return Clasification::instantiate(
            RaceName::fromString($data['raceName']) ?? null,
            IdPilot::fromString($data['idPilot']),
            PilotName::fromString($data["pilotName"]),
            Time::fromString($data['bestTime']) ?? null,
            Time::fromString($data['totalTime']),
            Points::fromInt($data['points'])
        );
    }
}

