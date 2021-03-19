<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\Aggregate;

interface AggregateId
{
    /**
     * @return mixed
     */
    public function value();
}
