<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use PHPUnit\Framework\TestCase;

class PublicationTest extends TestCase
{
    private $properties;

    protected function setUp(): void
    {
        $this->properties = [
            'title' => null,
            'publicationPath' => null,
            'authors' => null,
            'publisherDetails' => null,
            'nbCitations' => null,
            'citationsURL' => null,
            'year' => null,
        ];
    }

    private function createUnitUnderTest(array $properties): Publication
    {
        return new Publication($properties);
    }

    public function testGetTitle(): void
    {
        $this->properties['title'] = 'A Title';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['title'], $uut->getTitle());
    }

    public function testGetPublicationPath(): void
    {
        $this->properties['publicationPath'] = 'a-publication-path';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['publicationPath'], $uut->getPublicationPath());
    }

    public function testGetPublicationURL(): void
    {
        $this->properties['publicationPath'] = 'a-publication-path';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame(ProfilePageCrawler::getSchemeAndHostname() . $this->properties['publicationPath'], $uut->getPublicationURL());
    }

    public function testGetAuthors(): void
    {
        $this->properties['authors'] = 'Author 1, Author 2';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['authors'], $uut->getAuthors());
    }

    public function testGetPublisherDetails(): void
    {
        $this->properties['publisherDetails'] = 'A Journal, volume 1, issue 1, pages 1-10';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['publisherDetails'], $uut->getPublisherDetails());
    }

    public function testGetNbCitations(): void
    {
        $this->properties['nbCitations'] = '1';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['nbCitations'], $uut->getNbCitations());
    }

    public function testGetNbCitationsWhenNull(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['nbCitations'], $uut->getNbCitations());
    }

    public function testGetCitationsURL(): void
    {
        $this->properties['citationsURL'] = 'http://domain.tld/citation';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['citationsURL'], $uut->getCitationsURL());
    }

    public function testGetCitationsURLWhenNull(): void
    {
        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame($this->properties['citationsURL'], $uut->getCitationsURL());
    }

    public function testGetYear(): void
    {
        $this->properties['year'] = '2019';

        $uut = $this->createUnitUnderTest($this->properties);

        $this->assertSame((int)$this->properties['year'], $uut->getYear());
    }
}
