<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\CreatePilot;
use DevAway\KartCompetition\Competition\Application\Exception\PilotExists;
use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;

class CreatePilotHandler
{
    private PilotRepository $repository;

    /**
     * CreatePilotHandler constructor.
     * @param PilotRepository $repository
     */
    public function __construct(PilotRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreatePilot $command
     * @return Pilot
     * @throws PilotExists
     */
    public function handle(CreatePilot $command): Pilot
    {
        $filters = ['id' => $command->id()];
        $criteria = Criteria::create(Filters::fromValues($filters));

        $foundPilot = $this->repository->findBy($criteria);

        if (!empty($foundPilot)) {
            throw new PilotExists();
        }

        $pilot = Pilot::instantiate(
            Id::fromString($command->id()),
            Photo::fromString($command->photo()),
            Team::fromString($command->team()),
            PilotName::fromString($command->name()),
            Age::fromInt($command->age())
        );

         $this->repository->create($pilot);

         return $pilot;
    }
}
