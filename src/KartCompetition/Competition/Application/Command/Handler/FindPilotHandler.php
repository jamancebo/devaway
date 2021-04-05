<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\FindPilot;
use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;

class FindPilotHandler
{
    private PilotRepository $repository;

    /**
     * FindPilotHandler constructor.
     * @param PilotRepository $repository
     */
    public function __construct(PilotRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindPilot $command
     * @return Pilot
     */
    public function handle(FindPilot $command): Pilot
    {
        $pilot = $this->repository->find(IdPilot::fromString($command->id()));

        if (empty($pilot)) {
            throw new PilotNotFound("No Pilot found", 404);
        }

        return $pilot;
    }
}
