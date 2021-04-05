<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Application\DataTransformer\PilotToArray;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class PilotToArrayTest extends CompetitionModuleUnitCase
{
    private PilotToArray $dataTransformer;

    public function setUp(): void
    {
        $this->dataTransformer = new PilotToArray();
    }

    public function testTransform(): array
    {
        $pilot = PilotMother::random();
        $array = $this->dataTransformer->transform($pilot);

        $this->assertEquals($array['id'], $pilot->id()->value());
        $this->assertEquals($array['photo'], $pilot->photo()->value());
        $this->assertEquals($array['team'], $pilot->team()->value());
        $this->assertEquals($array['name'], $pilot->name()->value());
        $this->assertEquals($array['age'], $pilot->age()->value());

        return [
            'array' => $array,
            'pilot' => $pilot
        ];
    }

    /**
     * @depends testTransform
     * @param array $data
     */
    public function testReverseTransform(array $data)
    {
        $pilot = $this->dataTransformer->reverseTransform($data['array']);
        $this->assertEquals($data['pilot'], $pilot);
    }
}
