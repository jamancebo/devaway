<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use Faker\Factory;

class PhotoMother
{
    /**
     * @param string $photo
     * @return Photo
     */
    public static function create(string $photo): Photo
    {
        return Photo::fromString($photo);
    }

    /**
     * @return Photo
     */
    public static function random(): Photo
    {
        $faker = Factory::create('es_ES');
        return self::create($faker->imageUrl());
    }
}
