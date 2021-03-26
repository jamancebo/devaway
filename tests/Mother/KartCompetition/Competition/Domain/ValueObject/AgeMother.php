<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use Faker\Factory;

class AgeMother
{
    /**
     * @param int $age
     * @return Age
     */
    public static function create(int $age): Age
    {
        return Age::fromInt($age);
    }

    /**
     * @return Age
     */
    public static function random(): Age
    {
        $faker = Factory::create();
        return self::create($faker->numberBetween(20, 50));
    }
}
