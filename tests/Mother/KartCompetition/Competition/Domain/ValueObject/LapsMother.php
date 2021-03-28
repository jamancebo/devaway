<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use Faker\Factory as FakerFactory;

class LapsMother
{
    /**
     * @param string[] $time
     * @return Laps
     */
    public static function create(array $time): Laps
    {
        return new Laps(
            array_map(fn ($time) => Time::fromString($time), $time)
        );
    }

    /**
     * @param int|null $numberOflaps
     * @return Laps
     */
    public static function random(?int $numberOflaps = null): Laps
    {
        $faker = FakerFactory::create('es_ES');

        $laps = [];
        $numberOflaps = $numberOflaps ?? $faker->numberBetween(1, 10);
        for ($i = 0; $i < $numberOflaps; $i++) {
            $laps[] = $faker->time('i:s');
        }

        return self::create($laps);
    }
}