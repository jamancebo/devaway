<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria;

use DevAway\KartCompetition\Shared\Domain\Criteria\Filter;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;

class FiltersMother
{
    /**
     * @param Filter[] $filters
     * @return Filters
     */
    public static function create(array $filters): Filters
    {
        return new Filters($filters);
    }

    /**
     * @param int $numFilters
     * @return Filters
     */
    public static function random(int $numFilters = 1): Filters
    {
        $filters = [];

        for ($i = 0; $i < $numFilters; $i++) {
            $filters[] = FilterMother::random();
        }

        return self::create($filters);
    }

    /**
     * @return Filters
     */
    public static function empty(): Filters
    {
        return Filters::fromValues([]);
    }
}
