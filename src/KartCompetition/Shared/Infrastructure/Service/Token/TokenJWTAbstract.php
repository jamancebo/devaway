<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Infrastructure\Service\Token;

class TokenJWTAbstract
{
    private string $key;

    /**
     * @param string $key
     */
    protected function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    protected function key(): string
    {
        return $this->key;
    }
}
