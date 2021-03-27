<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateRoot;

class Pilot extends AggregateRoot
{
    private ?Id $id;
    private Photo $photo;
    private Team $team;
    private PilotName $name;
    private Age $age;
    private Points $points;

    /**
     * Pilot constructor.
     * @param Id|null $id
     * @param Photo $photo
     * @param Team $team
     * @param PilotName $name
     * @param Age $age
     * @param Points $points
     */
    public function __construct(
        ?Id $id,
        Photo $photo,
        Team $team,
        PilotName $name,
        Age $age,
        Points $points
    ) {
        $this->id = $id;
        $this->photo = $photo;
        $this->team = $team;
        $this->name = $name;
        $this->age = $age;
        $this->points = $points;
    }

    /**
     * @param Id|null $id
     * @param Photo $photo
     * @param Team $team
     * @param PilotName $name
     * @param Age $age
     * @param Points $points
     * @return Pilot
     */
    public static function instantiate(
        ?Id $id,
        Photo $photo,
        Team $team,
        PilotName $name,
        Age $age,
        Points $points
    ): self {
        return new self($id, $photo, $team, $name, $age, $points);
    }

    /**
     * @return Id|null
     */
    public function id(): ?Id
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

    /**
     * @return Points
     */
    public function points(): Points
    {
        return $this->points;
    }
}
