<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\Event;

use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateId;

interface DomainEvent
{
    /**
     * @return AggregateId
     */
    public function getAggregateId(): AggregateId;

    /**
     * @return array
     */
    public function toPrimitives(): array;

    /**
     * @param array $primitives
     * @return self
     */
    public static function fromPrimitives(array $primitives): self;
}
