<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;

class TimeMother
{
    public const BESTTIME = '00:00:40.333';
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
        return self::create('00:08:40.333');
    }

    /**
     * @return Time
     */
    public static function bestTimeRandom(): Time
    {
        return self::create(self::BESTTIME);
    }
}
