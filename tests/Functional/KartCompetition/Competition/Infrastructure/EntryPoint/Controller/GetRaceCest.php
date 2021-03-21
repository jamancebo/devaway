<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use FunctionalTester;

class GetRaceCest
{
    public function testPageLoaded(FunctionalTester $I)
    {
        $I->amOnPage('/v1/race/1');
        $I->canSeeResponseCodeIs(200);
    }
}
