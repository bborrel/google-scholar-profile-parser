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
     * @return array<string, array<string, string>|string>
     */
    public function parse()
    {
        $sinceYear = $this->parseSinceYear();

        $metrics = $this->parseMetrics();

        $nbCitationsPerYear = $this->parseNbCitationsPerYear();

        return array_merge($sinceYear, $metrics, $nbCitationsPerYear);
    }

    /**
     * @return array<string, string>
     */
    private function parseSinceYear()
    {
        /** @var Crawler $crawlerSinceYear */
        $crawlerSinceYear = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_SINCE_YEAR);

        /** @var DOMElement $element */
        $element = $crawlerSinceYear->getNode(0);

        return ['sinceYear' => $this->extractSinceYear($element->textContent)];
    }

    /**
     * @param string $text 'Since YYYY'
     * @return string
     */
    private function extractSinceYear($text)
    {
        return substr($text, strlen('Since '));
    }

    /**
     * @return array<string, string>
     */
    private function parseMetrics()
    {
        $metrics = array_flip([
            'nbCitations', 'nbCitationsSince', 'hIndex', 'hIndexSince', 'i10Index', 'i10IndexSince'
        ]);

        /** @var Crawler $crawlerMetrics */
        $crawlerMetrics = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_METRICS);

        /** @var DOMElement $domMetric */
        foreach ($crawlerMetrics as $domMetric) {
            $metrics[key($metrics)] = $domMetric->textContent;
            next($metrics);
        }

        return $metrics;
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function parseNbCitationsPerYear()
    {
        $nbCitations = [];

        /** @var Crawler $crawlerYears */
        $crawlerYears = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_YEARS);

        /** @var DOMElement $domYear */
        foreach ($crawlerYears as $domYear) {
            $nbCitations[] = $domYear->textContent;
        }

        $nbCitations = array_flip($nbCitations);

        /** @var Crawler $crawlerNbCitations */
        $crawlerNbCitations = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_NB_CITATIONS);

        /** @var DOMElement $domNbCitations */
        foreach ($crawlerNbCitations as $domNbCitations) {
            $nbCitations[key($nbCitations)] = $domNbCitations->textContent;
            next($nbCitations);
        }

        return ['nbCitationsPerYear' => $nbCitations];
    }
}
