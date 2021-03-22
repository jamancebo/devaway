<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\EntryPoint;

interface EntryPointResponse
{
    /**
     * @param array $entity
     * @param integer $code
     * @return mixed
     */
    public function response(array $entity, int $code);

    /**
     * @param string $data
     * @param integer $code
     */
    public function error(string $data, int $code);
}
