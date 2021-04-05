<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Service;

use DevAway\KartCompetition\Competition\Application\Service\GeneralClasification;
use DevAway\KartCompetition\Competition\Domain\Entity\Clasification;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class GeneralClasificationTest extends CompetitionModuleUnitCase
{
    private GeneralClasification $clasification;

    public function setUp(): void
    {
        $this->clasification = new GeneralClasification();
    }

    public function testGeneralClasification()
    {
        $array = RaceMother::randomArray(2);
        $idPilot = IdPilotMother::random();

        $clasification = $this->clasification->execute($array, $idPilot->value());

        $this->assertInstanceOf(Clasification::class, $clasification);
    }
}
