<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use Faker\Factory;

class TimeMother
{
    /**
     * @param string $name
     * @return Time
     */
    public static function create(string $name): Time
    {
        return Time::fromString($name);
    }

    /**
     * @return Time
     */
    public static function random(): Time
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->time('i:s'));
    }
}
