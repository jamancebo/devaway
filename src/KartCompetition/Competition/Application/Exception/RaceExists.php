<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Exception;

use Exception;

class RaceExists extends Exception
{
    protected $code = -1;
    protected $message = 'Race with the id already exists';
}
