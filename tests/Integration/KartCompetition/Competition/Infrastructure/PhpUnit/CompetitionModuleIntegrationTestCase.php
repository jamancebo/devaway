<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\PhpUnit;

use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Integration\KartCompetition\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use Doctrine\DBAL\Exception;

class CompetitionModuleIntegrationTestCase extends IntegrationTestCase
{
    private RaceRepository $raceRepository;
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures();
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        $this->purge();
    }

    /**
     * @return RaceRepository
     */
    public function repository(): RaceRepository
    {
        if (empty($this->raceRepository)) {
            return $this->service(RaceRepository::class);
        }
    }
}
