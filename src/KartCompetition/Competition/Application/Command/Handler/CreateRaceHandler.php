<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;

class CreateRaceHandler
{
    private RaceRepository $repository;
    private PilotRepository $pilotRepository;

    /**
     * CreateRaceHandler constructor.
     * @param RaceRepository $repository
     * @param PilotRepository $pilotRepository
     */
    public function __construct(RaceRepository $repository, PilotRepository $pilotRepository)
    {
        $this->repository = $repository;
        $this->pilotRepository = $pilotRepository;
    }

    /**
     * @param CreateRace $command
     * @return array
     */
    public function handle(CreateRace $command): array
    {
        $arrayRaces = [];

        $filters = ['id' => $command->idPilot()];
        $criteria = Criteria::create(Filters::fromValues($filters));

        $foundPilot = $this->pilotRepository->findBy($criteria);

        if (empty($foundPilot)) {
            throw new PilotNotFound();
        }

        foreach ($command->races() as $races) {
            $laps = $this->joinLaps($races["laps"]);
            $race = Race::instantiate(
                Id::random(),
                RaceName::fromString($races["name"]),
                IdPilot::fromString($command->idPilot()),
                Laps::fromValues($laps)
            );
            $this->repository->create($race);
            $arrayRaces[] = $race;
        }
        return $arrayRaces;
    }

    /**
     * @param array $array
     * @return array
     */
    private function joinLaps(array $array): array
    {
        $timeLaps = [];
        foreach ($array as $time) {
            $timeLaps[] = $time["time"];
        }
        return $timeLaps;
    }
}
