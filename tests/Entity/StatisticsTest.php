<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

use PHPUnit\Framework\TestCase;

class StatisticsTest extends TestCase
{
    /** @var array<string, ?mixed> */
    private array $properties;

    protected function setUp(): void
    {
        $this->properties = [
            'nbCitations'        => '1',
            'nbCitationsSince'   => '1',
            'hIndex'             => '1',
            'hIndexSince'        => '1',
            'i10Index'           => '1',
            'i10IndexSince'      => '1',
            'sinceYear'          => '2010',
            'nbCitationsPerYear' => [
                '2018' => 10,
                '2019' => 20,
            ],
        ];
    }

    /**
     * @param array<string, ?mixed> $properties
     */
    private function createUnitUnderTest(array $properties): Statistics
    {
        return new Statistics($properties);
    }

    public function testGettersAfterHappyPathHydration(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int) $this->properties['nbCitations'],      $uut->getNbCitations());
        $this->assertSame((int) $this->properties['nbCitationsSince'], $uut->getNbCitationsSince());
        $this->assertSame((int) $this->properties['hIndex'],           $uut->getHIndex());
        $this->assertSame((int) $this->properties['hIndexSince'],      $uut->getHIndexSince());
        $this->assertSame((int) $this->properties['i10Index'],         $uut->getI10Index());
        $this->assertSame((int) $this->properties['i10IndexSince'],    $uut->getI10IndexSince());
        $this->assertSame((int) $this->properties['sinceYear'],        $uut->getSinceYear());
    }

    public function testGetNbCitationsPerYear(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);
        $this->assertSame(['2018' => 10, '2019' => 20], $uut->getNbCitationsPerYear());
    }
}
