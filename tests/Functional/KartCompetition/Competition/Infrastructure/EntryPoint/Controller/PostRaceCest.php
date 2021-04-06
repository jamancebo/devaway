<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class PostRaceCest extends FunctionalCestCase
{
    private const TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJhZG1pbiIsImV4cCI6MTgwNjMwNjUyMH0.T0EnxMFv95p-n-HTUEmRDlHAJD7YUzXqZpc9YDP2824';

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

    /**
     * @param FunctionalTester $I
     */
    public function testErrorWhenUnauthorized(FunctionalTester $I)
    {
        $I->sendPost('v1/race', '');
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    /**
     * @param FunctionalTester $I
     */
    public function testErrorWhenUnauthorizedRole(FunctionalTester $I)
    {
        // phpcs:ignore Generic.Files.LineLength -- JWT cannot be shortened
        $jwtRoleGuest = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJndWVzdCIsImV4cCI6MTgwNjMwNjUyMH0.teAzg9HalGvJnGPcNWYGY7vTWZtbcmoCePJEEUwAPHY';
        $I->haveHttpHeader('Authorization', 'Bearer ' . $jwtRoleGuest);
        $I->sendPost('v1/race', '');
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    /**
     * @param FunctionalTester $I
     */
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
        $I->haveHttpHeader('Authorization', 'Bearer ' . self::TOKEN);
        $I->sendPost('v1/race', $races);
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY);
    }

    /**
     * @param FunctionalTester $I
     */
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
        $I->haveHttpHeader('Authorization', 'Bearer ' . self::TOKEN);
        $I->sendPOST('/v1/race', $races);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(HttpCode::CREATED);
    }
}
