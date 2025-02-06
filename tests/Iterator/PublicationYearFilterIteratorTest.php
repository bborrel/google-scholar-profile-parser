<?php

/**
 * @file
 */

namespace GScholarProfileParser\Iterator;

use ArrayIterator;
use GScholarProfileParser\Entity\Publication;
use PHPUnit\Framework\TestCase;

class PublicationYearFilterIteratorTest extends TestCase
{
    /** @var array[Publication] */
    private $allPublications;

    /** @var array[Publication] */
    private $expectedPublications;

    protected function setUp(): void
    {
        $publication1_2019 = new Publication([
            'title' => 'Title 1',
            'publicationPath' => '/path1',
            'authors' => 'Author 11, Author 12',
            'publisherDetails' => 'publisher 1',
            'year' => '2019'
        ]);

        $publication2_2018 = new Publication([
            'title' => 'Title 2',
            'publicationPath' => '/path2',
            'authors' => 'Author 21, Author 22',
            'publisherDetails' => 'publisher 2',
            'year' => '2018'
        ]);

        $publication3_2017 = new Publication([
            'title' => 'Title 3',
            'publicationPath' => '/path3',
            'authors' => 'Author 31, Author 32',
            'publisherDetails' => 'publisher 3',
            'year' => '2017'
        ]);

        $this->allPublications = [$publication1_2019, $publication2_2018, $publication3_2017];
        $this->expectedPublications = [$publication1_2019];
    }

    /**
     * @covers \GScholarProfileParser\Iterator\PublicationYearFilterIterator::<public>
     */
    public function testPublicationYearFilterFiltersIn(): void
    {
        $actualPublications = [];

        /** @var PublicationYearFilterIterator $publications_2019 */
        $publications_2019 = $this->createUnitUnderTest(2019);

        /** @var Publication $publication */
        foreach ($publications_2019 as $publication) {
            $actualPublications[] = $publication;
        }

        $this->assertSame($this->expectedPublications, $actualPublications);
    }

    /**
     * @param int $year
     * @return PublicationYearFilterIterator
     */
    private function createUnitUnderTest($year): PublicationYearFilterIterator
    {
        return new PublicationYearFilterIterator(new ArrayIterator($this->allPublications), $year);
    }
}
