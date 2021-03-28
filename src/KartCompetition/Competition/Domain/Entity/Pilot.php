<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateRoot;

class Pilot extends AggregateRoot
{
    private IdPilot $id;
    private Photo $photo;
    private Team $team;
    private PilotName $name;
    private Age $age;

    /**
     * Pilot constructor.
     * @param IdPilot $id
     * @param Photo $photo
     * @param Team $team
     * @param PilotName $name
     * @param Age $age
     */
    public function __construct(
        IdPilot $id,
        Photo $photo,
        Team $team,
        PilotName $name,
        Age $age
    ) {
        $this->id = $id;
        $this->photo = $photo;
        $this->team = $team;
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @param IdPilot $id
     * @param Photo $photo
     * @param Team $team
     * @param PilotName $name
     * @param Age $age
     * @return Pilot
     */
    public static function instantiate(
        IdPilot $id,
        Photo $photo,
        Team $team,
        PilotName $name,
        Age $age
    ): self {
        return new self($id, $photo, $team, $name, $age);
    }

    /**
     * @return IdPilot
     */
    public function id(): IdPilot
    {
        return $this->id;
    }

    /**
     * @return Photo
     */
    public function photo(): Photo
    {
        return $this->photo;
    }

    /**
     * @return Team
     */
    public function team(): Team
    {
        return $this->team;
    }

    /**
     * @return PilotName
     */
    public function name(): PilotName
    {
        return $this->name;
    }

    /**
     * @return Age
     */
    public function age(): Age
    {
        return $this->age;
    }
}
