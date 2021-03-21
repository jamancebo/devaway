<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateRoot;

class Race extends AggregateRoot
{
    private ?Id $id;
    private Time $time;
    private Points $points;
    private RaceName $name;
    private IdPilot $idPilot;
    private Time $bestTime;

    /**
     * Race constructor.
     * @param Id|null $id
     * @param Time $time
     * @param Points $points
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Time $bestTime
     */
    public function __construct(
        ?Id $id,
        Time $time,
        Points $points,
        RaceName $name,
        IdPilot $idPilot,
        Time $bestTime
    ) {
        $this->id = $id;
        $this->time = $time;
        $this->points = $points;
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->bestTime = $bestTime;
    }

    /**
     * @param Id|null $id
     * @param Time $time
     * @param Points $points
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Time $bestTime
     * @return static
     */
    public static function instantiate(
        ?Id $id,
        Time $time,
        Points $points,
        RaceName $name,
        IdPilot $idPilot,
        Time $bestTime
    ) : self {
        return new self($id, $time, $points, $name, $idPilot, $bestTime);
    }

    /**
     * @return Id|null
     */
    public function id(): ?Id
    {
        return $this->id;
    }

    /**
     * @return Time
     */
    public function time(): Time
    {
        return $this->time;
    }

    /**
     * @return Points
     */
    public function points(): Points
    {
        return $this->points;
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
     * @return Time
     */
    public function bestTime(): Time
    {
        return $this->bestTime;
    }
}
