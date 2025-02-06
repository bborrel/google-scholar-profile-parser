<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Parses a scholar's profile page from Google Scholar and returns its publications.
 */
class PublicationParser extends BaseParser implements Parser
{

    public const GSCHOLAR_XPATH = '//table[@id="gsc_a_t"]/tbody[@id="gsc_a_b"]/tr[@class="gsc_a_tr"]';

    public const GSCHOLAR_CSS_CLASS_REFERENCE = 'gsc_a_t';
    public const GSCHOLAR_CSS_CLASS_REFERENCE_TITLE = 'gsc_a_at';
    public const GSCHOLAR_CSS_CLASS_CITATION = 'gsc_a_c';
    public const GSCHOLAR_CSS_CLASS_YEAR = 'gsc_a_y';
    public const GSCHOLAR_CSS_CLASS_GRAY = 'gs_gray';

    /**
     * @return array<int, array<string, string>>
     */
    public function parse(): array
    {
        $publications = [];

        /** @var Crawler $crawlerPublications */
        $crawlerPublications = $this->crawler->filterXPath(self::GSCHOLAR_XPATH);

        /** @var DOMElement $domPublication */
        foreach ($crawlerPublications as $domPublication) {
            $publications[] = $this->parsePublication($domPublication);
        }

        return $this->deduplicate($publications);
    }

    /**
     * @param DOMElement $domPublication
     * @return array<string, string>
     */
    private function parsePublication(DOMElement $domPublication): array
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
     * @return array<string, string>
     */
    private function parsePublicationTitle(DOMElement $node): array
    {
        $title = $publicationPath = $authors = $publisherDetails = '';
        $childNodeIndex = 0;

        /** @var DOMElement $childNode */
        foreach ($node->childNodes as $childNode) {
            $cssClass = $childNode->getAttribute('class');

            if ($cssClass === self::GSCHOLAR_CSS_CLASS_REFERENCE_TITLE) {
                $title = $childNode->textContent;
                $publicationPath = $childNode->getAttribute('href');
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_GRAY && $childNodeIndex === 1) {
                $authors = $childNode->textContent;
            } elseif ($cssClass === self::GSCHOLAR_CSS_CLASS_GRAY && $childNodeIndex === 2) {
                $publisherDetails = $this->extractPublisherDetailsWithoutYear($childNode->textContent);
            }

            ++$childNodeIndex;
        }

        return compact('title', 'publicationPath', 'authors', 'publisherDetails');
    }

    /**
     * @param DOMElement $node
     * @return array<string, string>
     */
    private function parsePublicationCitedBy(DOMElement $node): array
    {
        if (!is_numeric($node->textContent)) {
            return [];
        }

        /** @var DOMElement $firstChild */
        $firstChild = $node->firstChild;

        return [
            'nbCitations' => $node->textContent,
            'citationsURL' => $firstChild->getAttribute('href')
        ];
    }

    /**
     * @param DOMElement $node
     * @return array<string, string>
     */
    private function parsePublicationYear(DOMElement $node): array
    {
        return ['year' => $node->textContent];
    }

    /**
     * @param string $text A Publisher details text like 'Carbon 140, 201-209, 2018'
     * @return string
     */
    private function extractPublisherDetailsWithoutYear(string $text): string
    {
        $pos = strrpos($text, ',');

        if ($pos !== false) {
            return substr($text, 0, $pos);
        }

        return $text;
    }

    /**
     * Returns $publications array filtered out from any title-duplicated publications.
     *
     * @param array<int, array<string, string>> $publications
     * @return array<int, array<string, string>>
     */
    private function deduplicate(array $publications): array
    {
        return array_intersect_key($publications, array_unique(array_column($publications, 'title')));
    }
}
