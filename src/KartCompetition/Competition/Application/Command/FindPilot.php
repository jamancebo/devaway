<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class FindPilot
{
    private string $id;

    /**
     * FindPilot constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}
