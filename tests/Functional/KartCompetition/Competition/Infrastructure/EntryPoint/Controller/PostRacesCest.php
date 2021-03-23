<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class PostRacesCest extends FunctionalCestCase
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

    /**
     * @param FunctionalTester $I
     */
    public function testErrorOnEmptyRequestBody(FunctionalTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('v1/race', '');
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
    }

    public function testPost(FunctionalTester $I)
    {
        $race = [
            'time' => '10:01',
            'points' => 10,
            'name' => 'Juan de Angel',
            'idPilot' => '023b5652-c1c0-33ad-8cde-84f6aeae84e7',
            'bestTime' => '02:32'
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/v1/race', $race);

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType(
            [
                'status' => 'integer',
                'data' => [
                    'id' => 'string',
                    'time' => 'string',
                    'name' => 'string',
                    'points' => 'integer',
                    'idPilot' => 'string',
                    'bestTime' => 'string'
                ]
            ]
        );

        $I->seeResponseContainsJson(['data' => ['time' => $race['time']]]);
        $I->seeResponseContainsJson(['data' => ['name' => $race['name']]]);
        $I->seeResponseContainsJson(['data' => ['points' => $race['points']]]);
        $I->seeResponseContainsJson(['data' => ['idPilot' => $race['idPilot']]]);
        $I->seeResponseContainsJson(['data' => ['bestTime' => $race['bestTime']]]);
    }
}
