<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Application\DataTransformer\CompetitionToArray;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\ClasificationMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class CompetitionToArrayTest extends CompetitionModuleUnitCase
{
    private CompetitionToArray $dataTransformer;

    public function setUp(): void
    {
        $this->dataTransformer = new CompetitionToArray();
    }

    public function testTransform(): array
    {
        $clasification = ClasificationMother::random();
        $array = $this->dataTransformer->transform($clasification);

        $this->assertEquals($array['raceName'], $clasification->raceName()->value());
        $this->assertEquals($array['idPilot'], $clasification->idPilot()->value());
        $this->assertEquals($array['pilotName'], $clasification->pilotName()->value());
        $this->assertEquals($array['bestTime'], $clasification->bestTime()->value());
        $this->assertEquals($array['totalTime'], $clasification->totalTime()->value());
        $this->assertEquals($array['points'], $clasification->points()->value());

        return [
            'array' => $array,
            'clasification' => $clasification
        ];
    }

    /**
     * @depends testTransform
     * @param array $data
     */
    public function testReverseTransform(array $data)
    {
        $clasification = $this->dataTransformer->reverseTransform($data['array']);
        $this->assertEquals($data['clasification'], $clasification);
    }
}
