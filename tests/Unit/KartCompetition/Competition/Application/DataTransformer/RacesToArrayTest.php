<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\DataTransformer;

use DevAway\KartCompetition\Competition\Application\DataTransformer\RacesToArray;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class RacesToArrayTest extends CompetitionModuleUnitCase
{
    private RacesToArray $dataTransformer;

    public function setUp(): void
    {
        $this->dataTransformer = new RacesToArray();
    }

    /**
     * @return array
     */
    public function testTransform(): array
    {
        $race = RaceMother::random();
        $array = $this->dataTransformer->transform($race);

        $this->assertEquals($race->id()->value(), $array['id']);
        $this->assertEquals($race->idPilot()->value(), $array['idPilot']);
        $this->assertEquals($race->points()->value(), $array['points']);
        $this->assertEquals($race->name()->value(), $array['name']);
        $this->assertEquals($race->time()->value(), $array['time']);
        $this->assertEquals($race->bestTime()->value(), $array['bestTime']);

        return [
            'array' => $array,
            'race' => $race
        ];
    }

    /**
     * @depends testTransform
     * @param array $data
     */
    public function testReverseTransform(array $data)
    {
        $race = $this->dataTransformer->reverseTransform($data['array']);
        $this->assertEquals($data['race'], $race);
    }
}
