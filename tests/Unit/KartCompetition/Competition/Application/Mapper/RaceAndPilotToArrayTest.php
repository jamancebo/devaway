<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Mapper;

use DevAway\KartCompetition\Competition\Application\DataTransformer\PilotToArray;
use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\KartCompetition\Competition\Application\Mapper\RaceAndPilotToArray;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class RaceAndPilotToArrayTest extends CompetitionModuleUnitCase
{
    private RaceAndPilotToArray $mapper;
    private PilotToArray $pilotDataTransformer;
    private RacesToArray $raceDataTransformer;

    public function setUp(): void
    {
        $this->mapper = new RaceAndPilotToArray();
        $this->pilotDataTransformer = new PilotToArray();
        $this->raceDataTransformer = new RacesToArray();
    }

    public function testMap()
    {
        $arrayRaces[] = $this->raceDataTransformer->transform(RaceMother::random());
        $arrayPilots[] = $this->pilotDataTransformer->transform(PilotMother::random());

        $result = $this->mapper->map($arrayRaces, $arrayPilots);

        foreach ($result as $key => $item) {
            $this->assertEquals($arrayRaces[$key]['name'], $item['name']);
            $this->assertEquals($arrayRaces[$key]['idPilot'], $item['idPilot']);
            $this->assertEquals($arrayRaces[$key]['totalTime'], $item['totalTime']);
        }
    }
}
