<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use Faker\Factory;

class PointsMother
{
    /**
     * @param int $externalId
     * @return Points
     */
    public static function create(int $externalId): Points
    {
        return Points::fromInt($externalId);
    }

    /**
     * @return Points
     */
    public static function random(): Points
    {
        $faker = Factory::create();
        return self::create($faker->numberBetween(0, 25));
    }
}
