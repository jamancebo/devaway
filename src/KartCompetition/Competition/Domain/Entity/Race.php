<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateRoot;

class Race extends AggregateRoot
{
    private ?Id $id;
    private RaceName $name;
    private IdPilot $idPilot;
    private Laps $laps;
    private Time $bestTime;
    private Points $points;
    private Time $totalTime;

    /**
     * Race constructor.
     * @param Id|null $id
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Laps $laps
     * @param Time $bestTime
     * @param Time $totalTime
     * @param Points $points
     */
    public function __construct(
        ?Id $id,
        RaceName $name,
        IdPilot $idPilot,
        Laps $laps,
        Time $bestTime,
        Time $totalTime,
        Points $points
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->laps = $laps;
        $this->bestTime = $bestTime;
        $this->totalTime = $totalTime;
        $this->points = $points;
    }

    /**
     * @param Id|null $id
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Laps $laps
     * @param Time $bestTime
     * @param Time $totalTime
     * @param Points $points
     * @return static
     */
    public static function instantiate(
        ?Id $id,
        RaceName $name,
        IdPilot $idPilot,
        Laps $laps,
        Time $bestTime,
        Time $totalTime,
        Points $points
    ): self {
        return new self($id, $name, $idPilot, $laps, $bestTime, $totalTime, $points);
    }

    /**
     * @param Points $points
     */
    public function updatePoints(Points $points): void
    {
        $this->points = $points;
    }

    /**
     * @return Id|null
     */
    public function id(): ?Id
    {
        return $this->id;
    }

    /**
     * @return RaceName
     */
    public function name(): RaceName
    {
        return $this->name;
    }

    /**
     * @return IdPilot
     */
    public function idPilot(): IdPilot
    {
        return $this->idPilot;
    }

    /**
     * @return Laps
     */
    public function laps(): Laps
    {
        return $this->laps;
    }

    /**
     * @return Time
     */
    public function bestTime(): Time
    {
        return $this->bestTime;
    }

    /**
     * @return Time
     */
    public function totalTime(): Time
    {
        return $this->totalTime;
    }

    /**
     * @return Points
     */
    public function points(): Points
    {
        return $this->points;
    }
}
