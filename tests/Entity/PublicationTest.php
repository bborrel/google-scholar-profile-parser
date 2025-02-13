<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase
{
    /** @var array<string, ?string> */
    private array $properties;

    protected function setUp(): void
    {
        $this->properties = [
            'title'            => 'A title',
            'publicationPath'  => 'a/publication/path',
            'authors'          => 'Author 1, Author 2',
            'publisherDetails' => 'A Journal, volume 1, issue 1, pages 1-10',
            'nbCitations'      => '1',
            'citationsURL'     => 'http://domain.tld/citation',
            'year'             => '2019',
        ];
    }

    /**
     * @param array<string, ?string> $properties
     */
    private function createUnitUnderTest(array $properties): Publication
    {
        return new Publication($properties);
    }

    public function testGettersAfterHappyPathHydration(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['title'],             $uut->getTitle());
        $this->assertSame($this->properties['publicationPath'],   $uut->getPublicationPath());
        $this->assertSame($this->properties['authors'],           $uut->getAuthors());
        $this->assertSame($this->properties['publisherDetails'],  $uut->getPublisherDetails());
        $this->assertSame($this->properties['citationsURL'],      $uut->getCitationsURL());
        $this->assertSame((int) $this->properties['nbCitations'], $uut->getNbCitations());
        $this->assertSame((int)$this->properties['year'],         $uut->getYear());
    }

    public function testGetPublicationURL(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame(ProfilePageCrawler::getSchemeAndHostname() . $this->properties['publicationPath'], $uut->getPublicationURL());
    }

    public function testGetNbCitationsWhenNull(): void
    {
        $this->properties['nbCitations'] = null;

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertNull($uut->getNbCitations());
    }

    public function testGetCitationsURLWhenNull(): void
    {
        $this->properties['citationsURL'] = null;

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertNull($uut->getCitationsURL());
    }
}
