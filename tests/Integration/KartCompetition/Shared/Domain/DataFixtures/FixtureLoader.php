<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Shared\Domain\DataFixtures;

interface FixtureLoader
{
    public function loadFixtures();
    public function purge();
}
