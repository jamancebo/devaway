<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\DoctrineRepository;
use Doctrine\ORM\EntityManager;

class MysqlRaceRepository extends DoctrineRepository implements RaceRepository
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
    public function create(Race $race): void
    {
        $this->persist($race);
    }

    /**
     * @inheritDoc
     */
    public function find(Id $id): ?Race
    {
        $race = $this->entityManager->find(Race::class, $id->value());
        return $race;
    }

    /**
     * @inheritDoc
     */
    public function findPilotRaces(IdPilot $idPilot): array
    {
        /** @var Race[] $linkedCompanies */
        return $this->repository(Race::class)->findBy([
            'idPilot' => $idPilot->value()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function findBy(Criteria $criteria): array
    {
        return $this->repository(Race::class)->findBy(
            $criteria->plainFilters(),
            $criteria->plainOrders(),
            $criteria->limit(),
            $criteria->offset()
        );
    }

    /**
     * @inheritDoc
     */
    public function list(): array
    {
        return $this->repository(Race::class)->findAll();
    }
}
