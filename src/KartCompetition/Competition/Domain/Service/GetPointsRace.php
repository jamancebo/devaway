<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\Service;

use DateTime;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\KartCompetition\Shared\Domain\Criteria\Orders;
use Exception;
use Symfony\Component\VarDumper\Cloner\Data;

class GetPointsRace
{
    private RaceRepository $repository;

    /**
     * GetPointsRace constructor.
     * @param RaceRepository $repository
     */
    public function __construct(RaceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Race $race
     * @return void
     * @throws Exception
     */
    public function execute(Race $race): void
    {
        $this->updateGeneralPoints($race);
    }

    /**
     * @param Race $race
     */
    private function updateGeneralPoints(Race $race): void
    {
        $races = $this->repository->findBy(
            Criteria::create(
                Filters::fromValues(["id" => $race->id()->value()]),
                Orders::fromValues(['totalTime' => 'ASC'])
            )
        );

        foreach ($races as $key => $item) {
            if ($key > sizeof(ScoreRace::SCORE) - 1) {
                $item->updatePoints(Points::fromInt(0));
            } else {
                $item->updatePoints(Points::fromInt(ScoreRace::SCORE[$key]));
            }
            $this->repository->update($item);
        }
    }
}
