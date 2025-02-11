<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

/**
 * Parses a scholar's profile page from Google Scholar and returns data specified by implementing classes.
 */
interface ParserInterface
{
    /**
     * @return array<mixed, mixed>
     */
    public function parse(): array;
}
