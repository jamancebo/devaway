<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use Faker\Factory;

class IdMother
{
    /**
     * @param int $id
     * @return Id
     */
    public static function create(int $id): Id
    {
        return Id::fromInt($id);
    }

    /**
     * @return Id
     */
    public static function random(): Id
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->randomNumber());
    }
}
