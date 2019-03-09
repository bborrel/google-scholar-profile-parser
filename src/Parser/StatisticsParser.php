<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Parses a scholar's profile page from Google Scholar and returns its statistics.
 */
class StatisticsParser extends BaseParser implements Parser
{

    const GSCHOLAR_XPATH_SINCE_YEAR = '//table[@id="gsc_rsb_st"]//th[3]';
    const GSCHOLAR_XPATH_METRICS = '//table[@id="gsc_rsb_st"]//td[@class="gsc_rsb_std"]';
    const GSCHOLAR_XPATH_YEARS = '//div[@class="gsc_md_hist_b"]/span[@class="gsc_g_t"]';
    const GSCHOLAR_XPATH_NB_CITATIONS = '//div[@class="gsc_md_hist_b"]/a[@class="gsc_g_a"]';

    /**
     * @inheritdoc
     */
    public function parse()
    {
        $sinceYear['sinceYear'] = $this->parseSinceYear();

        $metrics = $this->parseMetrics();

        $nbCitationsPerYear = $this->parseNbCitationsPerYear();

        return array_merge($sinceYear, $metrics, $nbCitationsPerYear);
    }

    /**
     * @return string
     */
    private function parseSinceYear()
    {
        /** @var Crawler $crawlerSinceYear */
        $crawlerSinceYear = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_SINCE_YEAR);

        return $this->extractSinceYear($crawlerSinceYear->getNode(0)->textContent);
    }

    /**
     * @param string $text 'Since YYYY'
     * @return string
     */
    private function extractSinceYear($text)
    {
        return trim(strstr($text, ' '));
    }

    /**
     * @return array[]
     */
    private function parseMetrics()
    {
        $metrics = [];
        $metricsKeys = ['nbCitations', 'nbCitationsSince', 'hIndex', 'hIndexSince', 'i10Index', 'i10IndexSince'];

        /** @var Crawler $crawlerMetrics */
        $crawlerMetrics = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_METRICS);

        /** @var DOMElement $domMetric */
        foreach ($crawlerMetrics as $domMetric) {
            $metrics[] = $domMetric->textContent;
        }

        return array_combine($metricsKeys, $metrics);
    }

    /**
     * @return array[][]
     */
    private function parseNbCitationsPerYear()
    {
        $years = $nbCitations = [];

        /** @var Crawler $crawlerYears */
        $crawlerYears = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_YEARS);

        /** @var DOMElement $domYear */
        foreach ($crawlerYears as $domYear) {
            $years[] = $domYear->textContent;
        }

        /** @var Crawler $crawlerNbCitations */
        $crawlerNbCitations = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_NB_CITATIONS);

        /** @var DOMElement $domNbCitations */
        foreach ($crawlerNbCitations as $domNbCitations) {
            $nbCitations[] = $domNbCitations->textContent;
        }

        return ['nbCitationsPerYear' => array_combine($years, $nbCitations)];
    }
}
