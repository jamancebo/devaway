<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;

class PilotToArray
{
    /**
     * @param Pilot $pilot
     * @return array
     */
    public function transform(Pilot $pilot): array
    {
        return [
            'id' => $pilot->id()->value(),
            'photo' => $pilot->photo()->value(),
            'team' => $pilot->team()->value(),
            'name' => $pilot->name()->value(),
            'age' => $pilot->age()->value()
        ];
    }

    /**
     * @param array $data
     * @return Pilot
     */
    public function reverseTransform(array $data): Pilot
    {
        return Pilot::instantiate(
            IdPilot::fromString($data['id']),
            Photo::fromString($data['photo']),
            Team::fromString($data['team']),
            PilotName::fromString($data['name']),
            Age::fromInt($data['age'])
        );
    }
}
