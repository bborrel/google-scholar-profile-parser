<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;

class Publication
{

    /** @var string The publication title */
    private readonly string $title;

    /** @var string Relative path on Google Scholar to publication's detail web page */
    private readonly string $publicationPath;

    /** @var string List of authors, comma separated */
    private readonly string $authors;

    /** @var string Journal name, volume, issue, pages */
    private readonly string $publisherDetails;

    /** @var int|null Number of citations */
    private readonly ?int $nbCitations;

    /** @var string|null URL on Google Scholar to publication's citations web page */
    private readonly ?string $citationsURL;

    /** @var int Year of publication */
    private readonly int $year;

    public function __construct(array $properties)
    {
        $this->title = $properties['title'];
        $this->publicationPath = $properties['publicationPath'];
        $this->authors = $properties['authors'];
        $this->publisherDetails = $properties['publisherDetails'];
        $this->nbCitations = isset($properties['nbCitations']) ? (int) $properties['nbCitations'] : null;
        $this->citationsURL = $properties['citationsURL'] ?? null;
        $this->year = (int) $properties['year'];
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublicationPath(): string
    {
        return $this->publicationPath;
    }

    public function getPublicationURL(): string
    {
        return ProfilePageCrawler::getSchemeAndHostname() . $this->getPublicationPath();
    }

    public function getAuthors(): string
    {
        return $this->authors;
    }

    public function getPublisherDetails(): string
    {
        return $this->publisherDetails;
    }

    public function getNbCitations(): ?int
    {
        return $this->nbCitations;
    }

    public function getCitationsURL(): ?string
    {
        return $this->citationsURL;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}
