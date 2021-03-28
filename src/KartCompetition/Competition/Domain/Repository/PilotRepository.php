<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Repository;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;

interface PilotRepository
{
    /**
     * @param Pilot $pilot
     */
    public function create(Pilot $pilot): void;

    /**
     * @param IdPilot $id
     * @throws PilotNotFound
     * @return Pilot|null
     */
    public function find(IdPilot $id): ?Pilot;

    /**
     * @param Criteria $criteria
     * @return Pilot[]
     */
    public function findBy(Criteria $criteria): array;
}
