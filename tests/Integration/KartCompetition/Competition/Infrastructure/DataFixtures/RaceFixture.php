<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\DataFixtures;

use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RaceFixture implements FixtureInterface
{
    public const ID = '023b5652-c1c0-33ad-8cde-84f6aeae84e1';
    public const IDPILOT = 'c080319c-48e5-310a-8641-0116565bf1e1';
    /**
     * @var RaceRepository
     */
    private RaceRepository $repository;

    /**
     * @param RaceRepository $repository
     */
    public function __construct(RaceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $id = IdMother::create(self::ID);
        $time = TimeMother::create('23:22');
        $points = PointsMother::create(10);
        $name = RaceNameMother::create('Le mans');
        $idPilot = IdPilotMother::create("");
        $bestTime = TimeMother::create(self::IDPILOT);

        $race = RaceMother::create(
            $id,
            $time,
            $points,
            $name,
            $idPilot,
            $bestTime
        );

        $this->repository->create($race);
    }
}
