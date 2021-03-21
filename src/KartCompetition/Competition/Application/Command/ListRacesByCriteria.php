<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class ListRacesByCriteria
{
    private array $filters;
    private array $orders;
    private ?int $offset;
    private ?int $limit;

    /**
     * @param array|null $filters
     * @param array|null $orders
     * @param integer|null $offset
     * @param integer|null $limit
     */
    public function __construct(
        ?array $filters = null,
        ?array $orders = null,
        ?int $offset = null,
        ?int $limit = null
    ) {
        $this->filters = $filters ?? [];
        $this->orders = $orders ?? [];
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function orders(): array
    {
        return $this->orders;
    }

    /**
     * @return int|null
     */
    public function offset(): ?int
    {
        return $this->offset;
    }

    /**
     * @return int|null
     */
    public function limit(): ?int
    {
        return $this->limit;
    }
}
