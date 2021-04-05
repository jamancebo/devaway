<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Repository;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;

interface RaceRepository
{
    /**
     * @param Race $race
     */
    public function create(Race $race): void;

    /**
     * @param Id $id
     * @throws RaceNotFound
     * @return Race|null
     */
    public function find(Id $id): ?Race;

    /**
     * @param Criteria $criteria
     * @return Race[]
     */
    public function findBy(Criteria $criteria): array;

    /**
     * @return array
     */
    public function list(): array;

    /**
     * @param Race $race
     * @return Race
     */
    public function update(Race $race): Race;
}
