<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;

class FindAllRaceHandler
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
     * @param ListRacesByCriteria $command
     * @return Race
     */
    public function handler(ListRacesByCriteria $command): array
    {
        $criteria = $this->getCriteria(
            $command->filters(),
            $command->orders(),
            $command->offset(),
            $command->limit(),
        );

        $races = $this->repository->findBy($criteria);

        if (empty($races)) {
            throw new RaceNotFound("No Races found", 404);
        }

        return $races;
    }

    /**
     * @param array $filters
     * @param array $orders
     * @param integer|null $offset
     * @param integer|null $limit
     * @return Criteria
     */
    private function getCriteria(
        array $filters,
        array $orders,
        ?int $offset,
        ?int $limit
    ): Criteria {
        return Criteria::create(
            Filters::fromValues($filters),
            Orders::fromStrings($orders),
            $offset,
            $limit
        );
    }
}
