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
            'nbCitations' => null,
            'nbCitationsSince' => null,
            'hIndex' => null,
            'hIndexSince' => null,
            'i10Index' => null,
            'i10IndexSince' => null,
            'sinceYear' => null,
            'nbCitationsPerYear' => [],
        ];
    }

    /**
     * @param array<string, ?mixed> $properties
     */
    private function createUnitUnderTest(array $properties): Statistics
    {
        return new Statistics($properties);
    }

    public function testGetNbCitations(): void
    {
        $this->properties['nbCitations'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['nbCitations'], $uut->getNbCitations());
    }

    public function testGetNbCitationsSince(): void
    {
        $this->properties['nbCitationsSince'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['nbCitationsSince'], $uut->getNbCitationsSince());
    }

    public function testGetHIndex(): void
    {
        $this->properties['hIndex'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['hIndex'], $uut->getHIndex());
    }

    public function testGetHIndexSince(): void
    {
        $this->properties['hIndexSince'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['hIndexSince'], $uut->getHIndexSince());
    }

    public function testGetI10Index(): void
    {
        $this->properties['i10Index'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['i10Index'], $uut->getI10Index());
    }

    public function testGetI10IndexSince(): void
    {
        $this->properties['i10IndexSince'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['i10IndexSince'], $uut->getI10IndexSince());
    }

    public function testGetSinceYear(): void
    {
        $this->properties['sinceYear'] = '2010';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['sinceYear'], $uut->getSinceYear());
    }

    public function testGetNbCitationsPerYear(): void
    {
        $this->properties['nbCitationsPerYear'] = [2018 => '10', 2019 => '20'];

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame([2018 => 10, 2019 => 20], $uut->getNbCitationsPerYear());
    }
}
