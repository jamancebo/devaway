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
            'name' => 'Juan de Angel',
            'idPilot' => '023b5652-c1c0-33ad-8cde-84f6aeae84e7',
            'laps' => ['02:32','02:42','04:32','03:32']
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
                    'name' => 'string',
                    'idPilot' => 'string',
                    'laps' => 'array'
                ]
            ]
        );

        $I->seeResponseContainsJson(['data' => ['name' => $race['name']]]);
        $I->seeResponseContainsJson(['data' => ['idPilot' => $race['idPilot']]]);
        $I->seeResponseContainsJson(['data' => ['laps' => $race['laps']]]);
    }
}
