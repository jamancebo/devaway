<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\Aggregate;

use DevAway\KartCompetition\Shared\Domain\Event\DomainEvent;
use DevAway\KartCompetition\Shared\Domain\Event\DomainEvents;

class AggregateRoot
{
    /**
     * @var array|DomainEvent[]
     */
    private $recordedEvents = [];

    /**
     * @return DomainEvents
     */
    public function getRecordedEvents(): DomainEvents
    {
        return new DomainEvents($this->recordedEvents);
    }

    /**
     * @return void
     */
    public function clearRecordedEvents(): void
    {
        $this->recordedEvents = [];
    }

    /**
     * @param DomainEvent $event
     * @return void
     */
    protected function recordThat(DomainEvent $event): void
    {
        $this->recordedEvents[] = $event;
    }
}
