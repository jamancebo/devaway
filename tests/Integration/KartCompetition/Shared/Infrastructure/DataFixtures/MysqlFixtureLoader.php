<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Shared\Infrastructure\DataFixtures;

use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\DataFixtures\RaceFixture;
use DevAway\Tests\Integration\KartCompetition\Shared\Domain\DataFixtures\FixtureLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;

class MysqlFixtureLoader implements FixtureLoader
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var Loader
     */
    private Loader $loader;

    /**
     * @var RaceRepository
     */
    private RaceRepository $raceRepository;

    /**
     * @var ORMPurger
     */
    private ORMPurger $purger;

    /**
     * @var ORMExecutor
     */
    private ORMExecutor $executor;

    /**
     * @param EntityManager $entityManager
     * @param RaceRepository $raceRepository
     */
    public function __construct(
        EntityManager $entityManager,
        RaceRepository $raceRepository
    ) {
        $this->entityManager = $entityManager;
        $this->raceRepository = $raceRepository;
        $this->loader = new Loader();
        $this->addCustomFixtures();
        $this->purger = new ORMPurger();
        $this->executor = new ORMExecutor($this->entityManager, $this->purger);
    }

    /**
     * @return void
     */
    public function loadFixtures(): void
    {
        $this->executor->execute($this->loader->getFixtures(), true);
    }

    /**
     * @throws Exception
     */
    public function purge(): void
    {
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        $this->executor->purge();
        $this->entityManager->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        $this->entityManager->getConnection()->close();
    }

    /**
     * @return void
     */
    private function addCustomFixtures(): void
    {
        $this->loader->addFixture(
            new RaceFixture(
                $this->raceRepository
            )
        );
    }
}
