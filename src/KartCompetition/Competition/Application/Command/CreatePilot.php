<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Command;

class CreatePilot
{
    private string $id;
    private string $photo;
    private string $team;
    private string $name;
    private int $age;

    /**
     * CreatePilot constructor.
     * @param string $id
     * @param string $photo
     * @param string $team
     * @param string $name
     * @param int $age
     */
    public function __construct(
        string $id,
        string $photo,
        string $team,
        string $name,
        int $age
    ) {
        $this->id = $id;
        $this->photo = $photo;
        $this->team = $team;
        $this->name = $name;
        $this->age = $age;
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
    public function photo(): string
    {
        return $this->photo;
    }

    /**
     * @return string
     */
    public function team(): string
    {
        return $this->team;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function age(): int
    {
        return $this->age;
    }

}
