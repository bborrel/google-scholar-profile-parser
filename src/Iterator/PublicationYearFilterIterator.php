<?php

/**
 * @file
 */

namespace GScholarProfileParser\Iterator;

use FilterIterator;
use GScholarProfileParser\Entity\Publication;
use Iterator;

/**
 * Iterates over publications array while filtering in per year when it was published.
 */
class PublicationYearFilterIterator extends FilterIterator
{

    /** @var int Year when publication was published */
    private int $year;

    public function __construct(Iterator $iterator, int $filter)
    {
        parent::__construct($iterator);

        $this->year = $filter;
    }

    public function accept(): bool
    {
        if (!$this->getInnerIterator()->valid()) {
            return false;
        }

        /** @var Publication $publication */
        $publication = $this->current();

        return $publication->getYear() === $this->year;
    }
}
