<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\DataFixtures;

use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\AgeMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PhotoMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TeamMother;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PilotFixture implements FixtureInterface
{
    public const ID = 'c080319c-48e5-310a-8641-0116565bf1e1';
    /**
     * @var PilotRepository
     */
    private PilotRepository $repository;

    /**
     * @param PilotRepository $repository
     */
    public function __construct(PilotRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $id = IdMother::create(self::ID);
        $photo = PhotoMother::create('photo');
        $team = TeamMother::create("Renault");
        $name = PilotNameMother::create('Fernando Alonso');
        $age = AgeMother::create(22);

        $race = PilotMother::create(
            $id,
            $photo,
            $team,
            $name,
            $age
        );

        $this->repository->create($race);
    }
}