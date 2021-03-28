<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class CreateRace
{
    private string $idPilot;
    private array $races;

    /**
     * CreateRace constructor.
     * @param string $idPilot
     * @param array $races
     */
    public function __construct(
        string $idPilot,
        array $races
    ) {
        $this->idPilot = $idPilot;
        $this->races = $races;
    }

    /**
     * @return string
     */
    public function idPilot(): string
    {
        return $this->idPilot;
    }

    /**
     * @return array
     */
    public function races(): array
    {
        return $this->races;
    }
}
