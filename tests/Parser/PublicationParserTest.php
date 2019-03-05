<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class PublicationParserTest extends TestCase
{

    /** @var string $htmlFileName The filename of the fixture file containing a Google Scholar page for a profile */
    private $htmlFileName;

    /** @var resource $htmlFile The file handler to the fixture file */
    private $htmlFile;

    /** @var array actual parsed publications */
    private $parsedPublications;


    protected function setUp(): void
    {
        $this->htmlFileName = __DIR__ . '/../data/8daWuo4AAAAJ.html';
        $this->htmlFile = fopen($this->htmlFileName, 'r');

        $this->parsedPublications = [
            [
                'title' => 'Interaction of oxygen functionalized multi-walled carbon nanotube nanofluids with copper',
                'gScholarPath' => '/citations?view_op=view_citation&hl=fr&user=8daWuo4AAAAJ&pagesize=2&sortby=pubdate&citation_for_view=8daWuo4AAAAJ:NhqRSupF_l8C',
                'authors' => 'A Karthikeyan, S Coulombe, AM Kietzig, RS Stein, T van de Ven',
                'publisherDetails' => 'Carbon 140, 201-209',
                'year' => '2018',
            ],
            [
                'title' => 'Boiling heat transfer enhancement with stable nanofluids and laser textured copper surfaces',
                'gScholarPath' => '/citations?view_op=view_citation&hl=fr&user=8daWuo4AAAAJ&pagesize=2&sortby=pubdate&citation_for_view=8daWuo4AAAAJ:bFI3QPDXJZMC',
                'authors' => 'A Karthikeyan, S Coulombe, AM Kietzig',
                'publisherDetails' => 'International Journal of Heat and Mass Transfer 126, 287-296',
                'nbCitations' => '1',
                'citationsURL' => 'https://scholar.google.com/scholar?oi=bibs&hl=fr&cites=15502897746301575580',
                'year' => '2018',
            ]
        ];
    }

    protected function tearDown(): void
    {
        fclose($this->htmlFile);
    }

    public function testParse()
    {
        $publicationParser = new PublicationParser($this->createTestCrawler());

        $this->assertSame($this->parsedPublications, $publicationParser->parse());
    }

    private function createTestCrawler(): Crawler
    {
        $content = fread($this->htmlFile, filesize($this->htmlFileName));
        $crawler = new Crawler();
        $crawler->addContent($content, 'text/html; charset=ISO-8859-1');

        return $crawler;
    }
}
