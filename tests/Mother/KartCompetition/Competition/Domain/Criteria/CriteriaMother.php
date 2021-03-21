<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria;

use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;
use Faker\Factory;

class CriteriaMother
{
    /**
     * @param Filters $filter
     * @param Orders|null $orders
     * @param int|null $offset
     * @param int|null $limit
     * @return Criteria
     */
    public static function create(
        Filters $filter,
        ?Orders $orders = null,
        ?int $offset = null,
        ?int $limit = null
    ): Criteria {
        return Criteria::create(
            $filter,
            $orders ?? OrdersMother::empty(),
            $offset,
            $limit
        );
    }

    /**
     * @return Criteria
     */
    public static function randomAsc(): Criteria
    {
        return self::random(OrdersMother::randomAsc());
    }

    /**
     * @return Criteria
     */
    public static function randomDesc(): Criteria
    {
        return self::random(OrdersMother::randomDesc());
    }

    /**
     * @param Orders $orders
     * @return Criteria
     */
    private static function random(Orders $orders): Criteria
    {
        $faker = Factory::create();
        return self::create(
            FiltersMother::random(),
            $orders,
            $faker->numberBetween(0, 10),
            $faker->numberBetween(10, 20)
        );
    }

    /**
     * @return Criteria
     */
    public static function empty(): Criteria
    {
        return self::create(FiltersMother::empty(), OrdersMother::empty());
    }
}
