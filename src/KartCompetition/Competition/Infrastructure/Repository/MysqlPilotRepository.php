<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\DoctrineRepository;
use Doctrine\ORM\EntityManager;

class MysqlPilotRepository extends DoctrineRepository implements PilotRepository
{
    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    /**
     * @inheritDoc
     */
    public function create(Pilot $pilot): void
    {
        $this->persist($pilot);
    }

    /**
     * @inheritDoc
     */
    public function find(IdPilot $id): ?Pilot
    {
        $pilot = $this->entityManager->find(Pilot::class, $id->value());
        return $pilot;
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->repository(Pilot::class)->findBy(
            $criteria->plainFilters(),
            $criteria->plainOrders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }
}
