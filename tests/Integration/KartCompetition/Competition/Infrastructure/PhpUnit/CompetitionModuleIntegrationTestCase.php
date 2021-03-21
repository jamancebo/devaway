<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\PhpUnit;

use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Integration\KartCompetition\Shared\Infrastructure\PhpUnit\IntegrationTestCase;
use Doctrine\DBAL\Exception;

class CompetitionModuleIntegrationTestCase extends IntegrationTestCase
{
    /**
     * @return RaceRepository
     */
    public function repository(): RaceRepository
    {
        return $this->service(RaceRepository::class);
    }
}
