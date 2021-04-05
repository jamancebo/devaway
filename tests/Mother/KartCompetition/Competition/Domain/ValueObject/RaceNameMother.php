<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use Faker\Factory;

class RaceNameMother
{
    /**
     * @param string $name
     * @return RaceName
     */
    public static function create(string $name): RaceName
    {
        return RaceName::fromString($name);
    }

    /**
     * @return RaceName
     */
    public static function random(): RaceName
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->name());
    }
}
