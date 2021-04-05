<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use Faker\Factory;

class PilotNameMother
{
    /**
     * @param string $name
     * @return PilotName
     */
    public static function create(string $name): PilotName
    {
        return PilotName::fromString($name);
    }

    /**
     * @return PilotName
     */
    public static function random(): PilotName
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->name());
    }
}
