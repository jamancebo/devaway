<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Service;

use DateTime;
use DevAway\KartCompetition\Competition\Domain\Entity\Clasification;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;

class GeneralClasification
{
    public function execute(array $races, string $idPilot): Clasification
    {
        $points = 0;
        $initial = new DateTime("00:00:00.0000");
        $final = new DateTime("00:00:00.0000");
        foreach ($races as $race) {
            $points = $points + $race->points()->value();
            $time = new DateTime($race->totalTime()->value());
            $interval = $initial->diff($time);
            $final = $final->add($interval);
        }

        return Clasification::instantiate(
            RaceName::fromString("General"),
            IdPilot::fromString($idPilot),
            PilotName::fromString(""),
            null,
            Time::fromString($final->format("H:i:s.v")),
            Points::fromInt($points)
        );
    }
}
