<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Service;

use DateTime;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use Exception;

class GetBestTimeRace
{
    /**
     * @param Laps $laps
     * @return Time
     * @throws Exception
     */
    public function execute(Laps $laps)
    {
        return $this->raceBestTime($laps);
    }

    /**
     * @param Laps $laps
     * @return Time
     * @throws Exception
     */
    private function raceBestTime(Laps $laps): Time
    {
        $bestTime = new DateTime($laps->values()[0]);
        foreach ($laps->values() as $item) {
            $time = new DateTime($item);
            if ($time < $bestTime) {
                $bestTime = $time;
            }
        }
        return Time::fromString($bestTime->format("H:i:s.v"));
    }
}
