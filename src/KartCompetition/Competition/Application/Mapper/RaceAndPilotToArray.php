<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Mapper;

use Exception;

class RaceAndPilotToArray
{
    /**
     * @param array $races
     * @param array $pilots
     * @return array
     * @throws Exception
     */
    public function map(array $races, array $pilots): array
    {
        if (sizeof($races) != sizeof($pilots)) {
             throw new Exception("Error in map entities");
        }

        foreach ($races as $key => $race) {
            foreach ($pilots as $pilot) {
                if ($race["idPilot"] == $pilot["id"]) {
                    $races[$key]["pilotName"] = $pilot["name"];
                }
            }
        }
        return $races;
    }
}