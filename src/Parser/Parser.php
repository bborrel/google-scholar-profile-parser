<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;


/**
 * Parses a scholar's profile page from Google Scholar and returns data specified by implementing classes.
 */
interface Parser
{
    /**
     * @return array[int][]
     */
    public function parse();
}
