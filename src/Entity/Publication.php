<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

class Publication
{

    /** @var string Title */
    private $title;

    /** @var string Relative path on Google Scholar to publication's detail web page */
    private $gScholarPath;

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
        $this->gScholarPath = $properties['gScholarPath'];
        $this->authors = $properties['authors'];
        $this->publisherDetails = $properties['publisherDetails'];
        $this->nbCitations = isset($properties['nbCitations']) ? (int) $properties['nbCitations'] : null ;
        $this->citationsURL = isset($properties['citationsURL']) ? $properties['citationsURL'] : null;
        $this->year = (int) $properties['year'];
    }
}
