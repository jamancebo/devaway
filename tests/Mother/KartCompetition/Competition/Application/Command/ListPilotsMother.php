<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\ListPilotsByCriteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\OrdersMother;
use Faker\Factory;

class ListPilotsMother
{
    /**
     * @param Filters|null $filters
     * @param Orders|null $orders
     * @param int|null $offset
     * @param int|null $limit
     * @return ListPilotsByCriteria
     */
    public static function create(
        ?Filters $filters = null,
        ?Orders $orders = null,
        ?int $offset = null,
        ?int $limit = null
    ): ListPilotsByCriteria {
        $filters = $filters ?? Filters::fromValues([]);
        $orders = $orders ?? Orders::fromValues([]);

        return new ListPilotsByCriteria(
            $filters->plainFilters(),
            $orders->plainOrders(),
            $offset,
            $limit,
        );
    }

    /**
     * @return ListPilotsByCriteria
     */
    public static function random(): ListPilotsByCriteria
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
     * @return ListPilotsByCriteria
     */
    public static function withoutCriteria(): ListPilotsByCriteria
    {
        return self::create();
    }
}