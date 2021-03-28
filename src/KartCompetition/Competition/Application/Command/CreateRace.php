<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class CreateRace
{
    private string $name;
    private string $idPilot;
    private array $laps;

    /**
     * CreateRace constructor.
     * @param string $name
     * @param string $idPilot
     * @param array $laps
     */
    public function __construct(
        string $name,
        string $idPilot,
        array $laps
    ) {
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->laps = $laps;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
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
    public function laps(): array
    {
        return $this->laps;
    }
}
