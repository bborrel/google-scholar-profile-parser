<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

class Statistics
{

    /** @var int Number of citations */
    private $nbCitations;

    /** @var int Number of citations, since $sinceYear */
    private $nbCitationsSince;

    /** @var int h-index */
    private $hIndex;

    /** @var int h-index, since $sinceYear */
    private $hIndexSince;

    /** @var int i10-index */
    private $i10Index;

    /** @var int i10-index, since $sinceYear */
    private $i10IndexSince;

    /** @var int Year from which stats are computed */
    private $sinceYear;

    /** var array<string, string> List of number of citations, per year */
    private $nbCitationsPerYear;

    public function __construct(array $properties)
    {
        $this->nbCitations = (int)$properties['nbCitations'];
        $this->nbCitationsSince = (int)$properties['nbCitationsSince'];
        $this->hIndex = (int)$properties['hIndex'];
        $this->hIndexSince = (int)$properties['hIndexSince'];
        $this->i10Index = (int)$properties['i10Index'];
        $this->i10IndexSince = (int)$properties['i10IndexSince'];
        $this->sinceYear = (int)$properties['sinceYear'];

        /** @var string $nbCitationsPerYear */
        foreach ($properties['nbCitationsPerYear'] as &$nbCitationsPerYear) {
            $nbCitationsPerYear = (int)$nbCitationsPerYear;
        }
        unset($nbCitationsPerYear);
        $this->nbCitationsPerYear = $properties['nbCitationsPerYear'];
    }

    /**
     * @return int
     */
    public function getNbCitations() : int
    {
        return $this->nbCitations;
    }

    /**
     * @return int
     */
    public function getNbCitationsSince() : int
    {
        return $this->nbCitationsSince;
    }

    /**
     * @return int
     */
    public function getHIndex() : int
    {
        return $this->hIndex;
    }

    /**
     * @return int
     */
    public function getHIndexSince() : int
    {
        return $this->hIndexSince;
    }

    /**
     * @return int
     */
    public function getI10Index() : int
    {
        return $this->i10Index;
    }

    /**
     * @return int
     */
    public function getI10IndexSince() : int
    {
        return $this->i10IndexSince;
    }

    /**
     * @return int
     */
    public function getSinceYear() : int
    {
        return $this->sinceYear;
    }

    /**
     * @return array<string, string>
     */
    public function getNbCitationsPerYear() : array
    {
        return $this->nbCitationsPerYear;
    }
}
