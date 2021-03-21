<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria;

use DevAway\KartCompetition\Shared\Domain\Criteria\Order;
use Faker\Factory;

class OrderMother
{
    /**
     * @param string $field
     * @param string $type
     * @return Order
     */
    public static function create(string $field, string $type): Order
    {
        return Order::fromValues($field, $type);
    }

    /**
     * @return Order
     */
    public static function randomAsc(): Order
    {
        return self::random(Order::ASC);
    }

    /**
     * @return Order
     */
    public static function randomDesc(): Order
    {
        return self::random(Order::DESC);
    }

    /**
     * @param string $type
     * @return Order
     */
    public static function random(string $type): Order
    {
        $faker = Factory::create();
        return self::create($faker->word, $type);
    }
}
