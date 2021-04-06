<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class PostRaceCest extends FunctionalCestCase
{

    public function _before(FunctionalTester $I)
    {
        parent::setUp($I);
        $this->purge();
        $this->loadFixtures();
    }

    public function _after(FunctionalTester $I)
    {
        $this->purge();
    }


    public function testErrorOnEmptyRequestBody(FunctionalTester $I)
    {
        $races = [
            [
                "_id" => "5fd7dbd8ce3a40582fb9ee6b",
                "picture" => "http://placehold.it/64x64",
                "age" => 23,
                "races" => [
                    "name" => "Race 0",
                    "laps" => [
                        [
                            "time" => "00:10:31.078"
                        ],
                        [
                            "time" => "00:11:31.078"
                        ],
                        [
                            "time" => "00:09:31.078"
                        ]
                    ]
                ]
            ]
        ];
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPost('v1/race', $races);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
    }


    public function testPost(FunctionalTester $I)
    {
        $races = [
            [
                "_id" => "5fd7dbd8ce3a40582fb9ee6b",
                "picture" => "http://placehold.it/64x64",
                "age" => 23,
                "name" => "Cooke Rivers",
                "team" => "PROTODYNE",
                "races" => [
                    [
                        "name" => "Race 0",
                        "laps" => [
                            [
                                "time" => "00:10:31.078"
                            ],
                            [
                                "time" => "00:11:31.078"
                            ],
                            [
                                "time" => "00:09:31.078"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/v1/race', $races);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(HttpCode::CREATED);
    }
}
