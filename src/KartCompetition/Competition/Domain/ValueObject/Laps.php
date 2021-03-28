<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\ValueObject\TimeCollection;

class Laps extends TimeCollection
{
    /**
     * @inheritDoc
     */
    protected function type(): string
    {
        return Time::class;
    }

    /**
     * @param string[] $array
     * @return static
     */
    public static function fromValues(array $array): self
    {
        $values = [];

        foreach ($array as $string) {
            $values[] = Time::fromString($string);
        }

        return new self($values);
    }
}
