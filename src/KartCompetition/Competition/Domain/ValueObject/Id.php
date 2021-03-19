<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateId;
use DevAway\KartCompetition\Shared\Domain\Exception\NotNaturalValue;
use DevAway\KartCompetition\Shared\Domain\ValueObject\IntegerValueObject;

class Id extends IntegerValueObject implements AggregateId
{
    /**
     * @param int $value
     * @throws NotNaturalValue
     */
    protected function __construct(int $value)
    {
        $this->checkNaturalValue($value);
        parent::__construct($value);
    }

    /**
     * @param int $value
     * @throws NotNaturalValue
     */
    protected function checkNaturalValue(int $value): void
    {
        if ($value <= 0) {
            throw new NotNaturalValue();
        }
    }
}
