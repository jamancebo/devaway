<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class GetGeneralCompetitionRacesCest extends FunctionalCestCase
{
    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        parent::setUp($I);
        $this->purge();
        $this->loadFixtures();
    }

    /**
     * @param FunctionalTester $I
     */
    public function _after(FunctionalTester $I)
    {
        $this->purge();
    }

    public function testGetGeneralCompetition(FunctionalTester $I)
    {
        $I->sendGet("/v1/general");
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $response = json_decode($I->grabResponse(), true);
        $I->assertCount(1, $response['data']);

        $I->seeResponseContainsJson(['status' => HttpCode::OK]);
        $I->seeResponseContainsJson(
            [
                'data' => [
                    0 => [
                        'raceName' => 'General',
                        'idPilot' => 'c080319c-48e5-310a-8641-0116565bf1e1',
                        'pilotName' => 'Fernando Alonso',
                        'points' => 0
                    ]
                ]
            ]
        );
    }
}
