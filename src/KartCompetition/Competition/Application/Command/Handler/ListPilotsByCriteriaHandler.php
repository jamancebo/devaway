<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\ListPilotsByCriteria;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;

class ListPilotsByCriteriaHandler
{
    private PilotRepository $repository;

    /**
     * ListPilotsByCriteriaHandler constructor.
     * @param PilotRepository $repository
     */
    public function __construct(PilotRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ListPilotsByCriteria $command): array
    {
        $criteria = $this->getCriteria(
            $command->filters(),
            $command->orders(),
            $command->offset(),
            $command->limit(),
        );

        $pilots = $this->repository->findBy($criteria);

        if (empty($pilots)) {
            throw new PilotNotFound("No Races found", 404);
        }

        return $pilots;
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
            Orders::fromValues($orders),
            $offset,
            $limit
        );
    }
}