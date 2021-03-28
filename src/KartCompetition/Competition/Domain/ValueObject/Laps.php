<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\ValueObject\StringCollection;
use DevAway\KartCompetition\Shared\Domain\ValueObject\StringValueObject;

class Laps extends StringCollection
{
    /**
     * @inheritDoc
     */
    protected function type(): string
    {
        return StringValueObject::class;
    }

    /**
     * @param string[] $array
     * @return static
     */
    public static function fromValues(array $array): self
    {
        $values = [];

        foreach ($array as $string) {
            $values[] = StringValueObject::fromString($string);
        }

        return new self($values);
    }
}
