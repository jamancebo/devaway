<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class PostRaceCest extends FunctionalCestCase
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
            "_id" => "5fd7dbd8ce3a40582fb9ee6b",
            "picture" => "http://placehold.it/64x64",
            "age" => 23,
            'name' => 'Juan de Angel',
            "team" => "PROTODYNE",
            'races' => [
                [
                    'name' => "RACE 0",
                    'laps' => [
                        [
                            'time' => "14:03"
                        ],
                        [
                            'time' => "14:03"
                        ]
                    ]
                ]
            ]
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/v1/race', $race);

        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();
    }
}
