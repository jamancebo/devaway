<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\KartCompetition\Competition\Application\Exception\RaceExists;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;

class CreateRaceHandler
{
    private RaceRepository $repository;

    /**
     * CreateRaceHandler constructor.
     * @param RaceRepository $repository
     */
    public function __construct(RaceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateRace $command
     * @return Race
     * @throws RaceExists
     */
    public function handle(CreateRace $command): Race
    {
        $filters = ['name' => $command->name(), 'idPilot' => $command->idPilot()];
        $criteria = Criteria::create(Filters::fromValues($filters));
        $foundRace = $this->repository->findBy($criteria);

        if (!empty($foundRace)) {
            throw new RaceExists();
        }

        $race = Race::instantiate(
            Id::random(),
            Time::fromString($command->time()),
            Points::fromInt($command->points()),
            RaceName::fromString($command->name()),
            IdPilot::fromString($command->idPilot()),
            Time::fromString($command->bestTime())
        );

        $this->repository->create($race);

        return $race;
    }
}
