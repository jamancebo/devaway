<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria;

use DevAway\KartCompetition\Shared\Domain\Criteria\Filter;
use Faker\Factory;

class FilterMother
{
    /**
     * @param string $field
     * @param mixed $value
     * @return Filter
     */
    public static function create(string $field, $value): Filter
    {
        return Filter::fromValues($field, $value);
    }

    /**
     * @return Filter
     */
    public static function random(): Filter
    {
        $faker = Factory::create();
        return self::create($faker->word(), $faker->word());
    }
}
