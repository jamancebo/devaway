<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;

class Clasification
{
    private ?RaceName $raceName;
    private IdPilot $idPilot;
    private PilotName $pilotName;
    private ?Time $bestTime;
    private Time $totalTime;
    private Points $points;


    /**
     * Clasification constructor.
     * @param RaceName|null $raceName
     * @param IdPilot $idPilot
     * @param PilotName $pilotName
     * @param Time|null $bestTime
     * @param Time $totalTime
     * @param Points $points
     */
    public function __construct(
        ?RaceName $raceName,
        IdPilot $idPilot,
        PilotName $pilotName,
        ?Time $bestTime,
        Time $totalTime,
        Points $points
    ) {
        $this->raceName = $raceName;
        $this->idPilot = $idPilot;
        $this->pilotName = $pilotName;
        $this->bestTime = $bestTime;
        $this->totalTime = $totalTime;
        $this->points = $points;
    }

    /**
     * @param RaceName|null $raceName
     * @param IdPilot $idPilot
     * @param PilotName $pilotName
     * @param Time|null $bestTime
     * @param Time $totalTime
     * @param Points $points
     * @return static
     */
    public static function instantiate(
        ?RaceName $raceName,
        IdPilot $idPilot,
        PilotName $pilotName,
        ?Time $bestTime,
        Time $totalTime,
        Points $points
    ): self {
        return new Clasification($raceName, $idPilot, $pilotName, $bestTime, $totalTime, $points);
    }

    /**
     * @param PilotName $pilotName
     */
    public function updatePilotName(PilotName $pilotName): void
    {
        $this->pilotName = $pilotName;
    }

    /**
     * @return RaceName
     */
    public function raceName(): ?RaceName
    {
        return $this->raceName ?? null;
    }

    /**
     * @return IdPilot
     */
    public function idPilot(): IdPilot
    {
        return $this->idPilot;
    }

    /**
     * @return PilotName
     */
    public function pilotName(): PilotName
    {
        return $this->pilotName;
    }

    /**
     * @return Time Time
     */
    public function bestTime(): ?Time
    {
        return $this->bestTime ?? null;
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
