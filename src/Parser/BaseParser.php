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

    /** @var Crawler crawler */
    protected $crawler;

    /**
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }
}
