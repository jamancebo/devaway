<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class CreateRace
{
    private string $time;
    private int $points;
    private string $name;
    private string $idPilot;
    private string $bestTime;

    /**
     * CreateRace constructor.
     * @param string $time
     * @param int $points
     * @param string $name
     * @param string $idPilot
     * @param string $bestTime
     */
    public function __construct(
        string $time,
        int $points,
        string $name,
        string $idPilot,
        string $bestTime
    ) {
        $this->time = $time;
        $this->points = $points;
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->bestTime = $bestTime;
    }

    /**
     * @return string
     */
    public function time(): string
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function points(): int
    {
        return $this->points;
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
     * @return string
     */
    public function bestTime(): string
    {
        return $this->bestTime;
    }
}
