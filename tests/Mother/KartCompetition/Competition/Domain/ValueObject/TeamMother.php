<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use Faker\Factory;

class TeamMother
{
    /**
     * @param string $team
     * @return Team
     */
    public static function create(string $team): Team
    {
        return Team::fromString($team);
    }

    /**
     * @return Team
     */
    public static function random(): Team
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->city());
    }
}
