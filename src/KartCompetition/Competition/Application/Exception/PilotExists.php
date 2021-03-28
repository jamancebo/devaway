<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Application\Exception;

use Exception;

class PilotExists extends Exception
{
    protected $code = -1;
    protected $message = 'Pilot with the id already exists';
}
