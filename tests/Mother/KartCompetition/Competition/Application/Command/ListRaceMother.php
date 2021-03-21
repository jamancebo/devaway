<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\ListRacesByCriteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\OrdersMother;
use Faker\Factory;

class ListRaceMother
{
    /**
     * @param Filters|null $filters
     * @param Orders|null $orders
     * @param int|null $offset
     * @param int|null $limit
     * @return ListRacesByCriteria
     */
    public static function create(
        ?Filters $filters = null,
        ?Orders $orders = null,
        ?int $offset = null,
        ?int $limit = null
    ): ListRacesByCriteria {
        $filters = $filters ?? Filters::fromValues([]);
        $orders = $orders ?? Orders::fromValues([]);

        return new ListRacesByCriteria(
            $filters->plainFilters(),
            $orders->plainOrders(),
            $offset,
            $limit,
        );
    }

    /**
     * @return ListRacesByCriteria
     */
    public static function random(): ListRacesByCriteria
    {
        $faker = Factory::create('es_ES');

        return self::create(
            FiltersMother::random(),
            OrdersMother::randomDesc(),
            $faker->numberBetween(0, 100),
            $faker->numberBetween(1, 100),
        );
    }

    /**
     * @return ListRacesByCriteria
     */
    public static function withoutCriteria(): ListRacesByCriteria
    {
        return self::create();
    }
}
