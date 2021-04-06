<?php

declare(strict_types=1);

namespace DevAway\Tests\Functional\KartCompetition\Competition\Infrastructure\EntryPoint\Controller;

use Codeception\Util\HttpCode;
use DevAway\Tests\Functional\Shared\Infrastructure\Codeception\FunctionalCestCase;
use FunctionalTester;

class GetGeneralCompetitionRacesCest extends FunctionalCestCase
{
    private const TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJhZG1pbiIsImV4cCI6MTgwNjMwNjUyMH0.T0EnxMFv95p-n-HTUEmRDlHAJD7YUzXqZpc9YDP2824';
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
    public function testErrorWhenUnauthorized(FunctionalTester $I)
    {
        $I->sendGET('v1/general');
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
        $I->sendGET('v1/general');
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function testGetGeneralCompetition(FunctionalTester $I)
    {
        $I->haveHttpHeader('Authorization', 'Bearer ' . self::TOKEN);
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
