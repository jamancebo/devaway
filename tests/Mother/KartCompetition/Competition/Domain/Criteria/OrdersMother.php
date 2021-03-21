<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria;

use DevAway\KartCompetition\Shared\Domain\Criteria\Order;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;

class OrdersMother
{
    /**
     * @param Order[] $orders
     * @return Orders
     */
    public static function create(array $orders): Orders
    {
        return new Orders($orders);
    }

    /**
     * @param integer $numOrders
     * @return Orders
     */
    public static function randomAsc(int $numOrders = 1): Orders
    {
        return self::random($numOrders, Order::ASC);
    }

    /**
     * @param integer $numOrders
     * @return Orders
     */
    public static function randomDesc(int $numOrders = 1): Orders
    {
        return self::random($numOrders, Order::DESC);
    }

    /**
     * @param integer $numOrders
     * @param string $type
     * @return Orders
     */
    private static function random(int $numOrders, string $type): Orders
    {
        $orders = [];
        for ($i = 0; $i < $numOrders; $i++) {
            $orders[] = OrderMother::random($type);
        }

        return self::create($orders);
    }

    /**
     * @return Orders
     */
    public static function empty(): Orders
    {
        return Orders::fromValues([]);
    }
}
