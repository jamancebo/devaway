<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\Bus;

interface CommandBus
{
    /**
     * @param object $command
     */
    public function handle($command);
}
