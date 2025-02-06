<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use Symfony\Component\DomCrawler\Crawler;

/**
 * @codeCoverageIgnore
 */
abstract class BaseParser
{
    public function __construct(protected Crawler $crawler) {}
}
