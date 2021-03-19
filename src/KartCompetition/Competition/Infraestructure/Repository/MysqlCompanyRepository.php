<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infraestructure\Repository;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\DoctrineRepository;
use Doctrine\ORM\EntityManager;

class MysqlCompanyRepository extends DoctrineRepository implements RaceRepository
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
    public function create(Race $Race): void
    {
        $this->persist($Race);
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
        $pilotRaces = $this->repository(Race::class)->findBy([
            'idPilot' => $idPilot->value()
        ]);

        return $pilotRaces;
    }
}