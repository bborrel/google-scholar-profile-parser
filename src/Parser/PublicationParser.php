<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Parses a scholar's profile page from Google Scholar and returns publications into memory.
 *
 */
class PublicationParser
{

    const GSCHOLAR_XPATH_PUBLICATIONS = '//table[@id="gsc_a_t"]/tbody[@id="gsc_a_b"]/tr[@class="gsc_a_tr"]';

    const GSCHOLAR_CSS_CLASS_REFERENCE = 'gsc_a_t';
    const GSCHOLAR_CSS_CLASS_REFERENCE_TITLE = 'gsc_a_at';
    const GSCHOLAR_CSS_CLASS_CITATION = 'gsc_a_c';
    const GSCHOLAR_CSS_CLASS_YEAR = 'gsc_a_y';
    const GSCHOLAR_CSS_CLASS_GRAY = 'gs_gray';

    /** @var Crawler crawler */
    private $crawler;

    /**
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return array[int][]
     */
    public function parse()
    {
        $data = [];

        /** @var Crawler $crawlerPublications */
        $crawlerPublications = $this->crawler->filterXPath(self::GSCHOLAR_XPATH_PUBLICATIONS);

        /** @var DOMElement $domPublication */
        foreach ($crawlerPublications as $domPublication) {
            $data[] = $this->parsePublication($domPublication);
        }

        return $data;
    }

    /**
     * @param DOMElement $domPublication
     * @return array
     */
    private function parsePublication(DOMElement $domPublication)
    {
        $title = $citation = $year = [];

        /** @var DOMElement $node */
        foreach ($domPublication->childNodes as $node) {
            $cssClass = $node->getAttribute('class');

            if ($cssClass === self::GSCHOLAR_CSS_CLASS_REFERENCE) {
                $title = $this->parsePublicationTitle($node);
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_CITATION) {
                $citation = $this->parsePublicationCitedBy($node);
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_YEAR) {
                $year = $this->parsePublicationYear($node);
            }
        }

        return array_merge($title, $citation, $year);
    }

    /**
     * @param DOMElement $node
     * @return array
     */
    private function parsePublicationTitle(DOMElement $node)
    {
        $title = $gScholarPath = $authors = $publisherDetails = '';
        $childNodeIndex = 0;

        foreach ($node->childNodes as $childNode) {
            $cssClass = $childNode->getAttribute('class');

            if ($cssClass === self::GSCHOLAR_CSS_CLASS_REFERENCE_TITLE) {
                $title = $childNode->textContent;
                $gScholarPath = $childNode->getAttribute('data-href');
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_GRAY && $childNodeIndex === 1) {
                $authors = $childNode->textContent;
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_GRAY && $childNodeIndex === 2) {
                $publisherDetails = $this->extractPublisherDetailsWithoutYear($childNode->textContent);
            }

            ++$childNodeIndex;
        }

        return [
            'title' => $title,
            'gScholarPath' => $gScholarPath,
            'authors' => $authors,
            'publisherDetails' => $publisherDetails,
        ];
    }

    /**
     * @param DOMElement $node
     * @return array
     */
    private function parsePublicationCitedBy(DOMElement $node)
    {
        if (!is_numeric($node->textContent)) {
            return [];
        }

        return [
            'nbCitations' => $node->textContent,
            'citationsURL' => $node->firstChild->getAttribute('href')
        ];
    }

    /**
     * @param DOMElement $node
     * @return array
     */
    private function parsePublicationYear(DOMElement $node)
    {
        return ['year' => $node->textContent];
    }

    /**
     * @param string $text A Publisher details text like 'Carbon 140, 201-209, 2018'
     * @return bool|string
     */
    private function extractPublisherDetailsWithoutYear($text)
    {
        $pos = strrpos($text, ',');

        if ($pos !== false) {
            return substr($text, 0, $pos);
        }

        return $text;
    }
}
