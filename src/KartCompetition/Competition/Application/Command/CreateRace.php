<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class CreateRace
{
    /** @var string */
    private string $id;

    /** @var string */
    private string $time;

    /** @var int */
    private int $points;

    /** @var string */
    private string $name;

    /** @var string */
    private string $idPilot;

    /** @var string */
    private string $bestTime;

    /**
     * CreateRace constructor.
     * @param string $id
     * @param string $time
     * @param int $points
     * @param string $name
     * @param string $idPilot
     * @param string $bestTime
     */
    public function __construct(
        string $id,
        string $time,
        int $points,
        string $name,
        string $idPilot,
        string $bestTime
    ) {
        $this->id = $id;
        $this->time = $time;
        $this->points = $points;
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->bestTime = $bestTime;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
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
