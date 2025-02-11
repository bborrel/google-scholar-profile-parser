<?php

/**
 * @file
 */

namespace GScholarProfileParser\Entity;

class Statistics
{

    /** @var int Number of citations */
    private readonly int $nbCitations;

    /** @var int Number of citations, since $sinceYear */
    private readonly int $nbCitationsSince;

    /** @var int h-index */
    private readonly int $hIndex;

    /** @var int h-index, since $sinceYear */
    private readonly int $hIndexSince;

    /** @var int i10-index */
    private readonly int $i10Index;

    /** @var int i10-index, since $sinceYear */
    private readonly int $i10IndexSince;

    /** @var int Year from which stats are computed */
    private readonly int $sinceYear;

    /** @var array<string, string> List of number of citations, per year */
    private readonly array $nbCitationsPerYear;

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

    public function getNbCitations(): int
    {
        return $this->nbCitations;
    }

    public function getNbCitationsSince(): int
    {
        return $this->nbCitationsSince;
    }

    public function getHIndex(): int
    {
        return $this->hIndex;
    }

    public function getHIndexSince(): int
    {
        return $this->hIndexSince;
    }

    public function getI10Index(): int
    {
        return $this->i10Index;
    }

    public function getI10IndexSince(): int
    {
        return $this->i10IndexSince;
    }

    public function getSinceYear(): int
    {
        return $this->sinceYear;
    }

    public function getNbCitationsPerYear(): array
    {
        return $this->nbCitationsPerYear;
    }
}
