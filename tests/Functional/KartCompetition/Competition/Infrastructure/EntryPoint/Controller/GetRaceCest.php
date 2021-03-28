<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class GetRaceCest extends FunctionalCestCase
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

    public function testRaceNotFound(FunctionalTester $I)
    {
        $I->sendGet("/v1/race/023b5652-c1c0-33ad-8cde-84f6aeae84e3");
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(
            [
                'status' => 'integer',
                'detail' => 'string'
            ]
        );

        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $I->seeResponseContainsJson(
            [
                'status' => HttpCode::NOT_FOUND,
                'detail' => 'No Races found'
            ]
        );
    }

    public function testGetRace(FunctionalTester $I)
    {
        $I->sendGet("/v1/race/023b5652-c1c0-33ad-8cde-84f6aeae84e1");
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $response = json_decode($I->grabResponse(), true);
        $I->assertCount(1, $response['data']);

        $I->seeResponseMatchesJsonType(
            [
                'status' => 'integer',
                'data' => [
                    0 => [
                        'id' => 'string',
                        'name' => 'string',
                        'idPilot' => 'string',
                        'laps' => 'array'
                    ]
                ]
            ]
        );

        $I->seeResponseContainsJson(['status' => HttpCode::OK]);
        $I->seeResponseContainsJson(
            [
                'data' => [0 =>
                    [
                        'id' => '023b5652-c1c0-33ad-8cde-84f6aeae84e1'
                    ]
                ]
            ]
        );
    }
}
