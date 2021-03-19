<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use Faker\Factory;

class IdPilotMother
{
    /**
     * @param int $idPilot
     * @return IdPilot
     */
    public static function create(int $idPilot): IdPilot
    {
        return IdPilot::fromInt($idPilot);
    }

    /**
     * @return IdPilot
     */
    public static function random(): IdPilot
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->randomNumber());
    }
}
