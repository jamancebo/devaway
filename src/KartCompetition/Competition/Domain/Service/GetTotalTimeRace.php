<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Service;

use DateTime;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use Exception;

class GetTotalTimeRace
{
    /**
     * @param Laps $laps
     * @return Time
     * @throws Exception
     */
    public function execute(Laps $laps): Time
    {
        return $this->raceTime($laps);
    }

    /**
     * @param Laps $laps
     * @return Time
     * @throws Exception
     */
    private function raceTime(Laps $laps): Time
    {
        $initial = new DateTime("00:00:00.0000");
        $final = new DateTime("00:00:00.0000");
        foreach ($laps->values() as $item) {
            $time = new DateTime($item);
            $interval = $initial->diff($time);
            $final = $final->add($interval);
        }
        return Time::fromString($final->format("H:i:s.v"));
    }
}
