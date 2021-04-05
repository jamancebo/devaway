<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\Service\GetBestTimeRace;
use DevAway\KartCompetition\Competition\Domain\Service\GetPointsRace;
use DevAway\KartCompetition\Competition\Domain\Service\GetTotalTimeRace;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use Exception;

class CreateRaceHandler
{
    private RaceRepository $repository;
    private PilotRepository $pilotRepository;
    private GetTotalTimeRace $getTotalTimeRace;
    private GetBestTimeRace $getBestTimeRace;
    private GetPointsRace $getPointsRace;

    /**
     * CreateRaceHandler constructor.
     * @param RaceRepository $repository
     * @param PilotRepository $pilotRepository
     */
    public function __construct(RaceRepository $repository, PilotRepository $pilotRepository)
    {
        $this->repository = $repository;
        $this->pilotRepository = $pilotRepository;
        $this->getTotalTimeRace = new GetTotalTimeRace();
        $this->getBestTimeRace = new GetBestTimeRace();
        $this->getPointsRace = new GetPointsRace($this->repository);
    }

    /**
     * @param CreateRace $command
     * @return array
     * @throws Exception
     */
    public function handle(CreateRace $command): array
    {
        $arrayRaces = [];

        foreach ($command->races() as $race) {
            $id = $this->findId($race["name"]);
            $laps = $this->joinLaps($race["laps"]);
            $bestTime = $this->getBestTimeRace->execute($laps);
            $totalTime = $this->getTotalTimeRace->execute($laps);

            $createdRace = Race::instantiate(
                $id,
                RaceName::fromString($race["name"]),
                IdPilot::fromString($command->idPilot()),
                $laps,
                $bestTime,
                $totalTime,
                Points::fromInt(0)
            );

            $this->repository->create($createdRace);
            $this->getPointsRace->execute($createdRace);

            $arrayRaces[] = $createdRace;
        }

        return $arrayRaces;
    }

    /**
     * @param array $array
     * @return Laps
     */
    private function joinLaps(array $array): Laps
    {
        $timeLaps = [];
        foreach ($array as $time) {
            $timeLaps[] = $time["time"];
        }
        return Laps::fromValues($timeLaps);
    }

    /**
     * @param string $name
     * @return Id
     */
    private function findId(string $name): Id
    {
        $foundRace = $this->repository->findBy(
            Criteria::create(Filters::fromValues(['name' => $name]))
        );

        if (empty($foundRace)) {
            return Id::random();
        }

        return $foundRace[0]->id();
    }
}
