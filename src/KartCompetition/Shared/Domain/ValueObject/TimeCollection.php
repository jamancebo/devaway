<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\Utils\Collection;

abstract class TimeCollection extends Collection
{
    /**
     * @return string[]
     */
    public function values(): array
    {
        return array_map(
            fn (StringValueObject $stringVo) => $stringVo->value(),
            $this->items() ?? []
        );
    }
}