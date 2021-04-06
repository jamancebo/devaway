<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class GetPilotRacesCest extends FunctionalCestCase
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
        $I->sendGet("/v1/pilot/023b5652-c1c0-33ad-8cde-84f6aeae84e3");
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
                'detail' => 'No Pilot found'
            ]
        );
    }

    public function testGetRace(FunctionalTester $I)
    {
        $I->sendGet("/v1/pilot/c080319c-48e5-310a-8641-0116565bf1e1");
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
                        'laps' => 'array',
                        'bestTime' => 'string',
                        'totalTime' => 'string',
                        'points' => 'integer'
                    ]
                ]
            ]
        );

        $I->seeResponseContainsJson(['status' => HttpCode::OK]);
        $I->seeResponseContainsJson(
            [
                'data' => [0 =>
                    [
                        'id' => '023b5652-c1c0-33ad-8cde-84f6aeae84e1',
                        'name' => 'Le mans',
                        'idPilot' => 'c080319c-48e5-310a-8641-0116565bf1e1',
                        'bestTime' => '00:08:40.333',
                        'totalTime' => '00:08:40.333',
                        'points' => 10
                    ]
                ]
            ]
        );
    }
}