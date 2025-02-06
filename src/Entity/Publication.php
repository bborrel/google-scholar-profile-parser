<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;

class Publication
{

    /** @var string Title */
    private $title;

    /** @var string Relative path on Google Scholar to publication's detail web page */
    private $publicationPath;

    /** @var string List of authors, comma separated */
    private $authors;

    /** @var string Journal name, volume, issue, pages */
    private $publisherDetails;

    /** @var int|null Number of citations */
    private $nbCitations;

    /** @var string|null URL on Google Scholar to publication's citations web page */
    private $citationsURL;

    /** @var int Year of publication */
    private $year;

    /**
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->title = $properties['title'];
        $this->publicationPath = $properties['publicationPath'];
        $this->authors = $properties['authors'];
        $this->publisherDetails = $properties['publisherDetails'];
        $this->nbCitations = isset($properties['nbCitations']) ? (int)$properties['nbCitations'] : null;
        $this->citationsURL = $properties['citationsURL'] ?? null;
        $this->year = (int)$properties['year'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPublicationPath(): string
    {
        return $this->publicationPath;
    }

    /**
     * @return string
     */
    public function getPublicationURL(): string
    {
        return ProfilePageCrawler::getSchemeAndHostname() . $this->getPublicationPath();
    }

    /**
     * @return string
     */
    public function getAuthors(): string
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getPublisherDetails(): string
    {
        return $this->publisherDetails;
    }

    /**
     * @return int|null
     */
    public function getNbCitations(): ?int
    {
        return $this->nbCitations;
    }

    /**
     * @return string|null
     */
    public function getCitationsURL(): ?string
    {
        return $this->citationsURL;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }
}
