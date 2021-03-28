<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateRoot;

class Race extends AggregateRoot
{
    private ?Id $id;
    private RaceName $name;
    private IdPilot $idPilot;
    private Laps $laps;

    /**
     * Race constructor.
     * @param Id|null $id
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Laps $laps
     */
    public function __construct(
        ?Id $id,
        RaceName $name,
        IdPilot $idPilot,
        Laps $laps
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->idPilot = $idPilot;
        $this->laps = $laps;
    }

    /**
     * @param Id|null $id
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Laps $laps
     * @return static
     */
    public static function instantiate(
        ?Id $id,
        RaceName $name,
        IdPilot $idPilot,
        Laps $laps
    ): self {
        return new self($id, $name, $idPilot, $laps);
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
}
