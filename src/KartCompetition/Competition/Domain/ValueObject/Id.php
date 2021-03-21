<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\Aggregate\AggregateId;
use DevAway\KartCompetition\Shared\Domain\ValueObject\Uuid;

class Id extends Uuid implements AggregateId
{

}
