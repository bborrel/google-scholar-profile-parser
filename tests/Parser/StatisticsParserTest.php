<?php

/**
 * @file
 */

namespace GScholarProfileParser\Parser;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class StatisticsParserTest extends TestCase
{

    /** @var string $htmlFileName The filename of the fixture file containing a Google Scholar page for a profile */
    private string $htmlFileName;

    /** @var resource $htmlFile The file handler to the fixture file */
    private $htmlFile;

    /** @var array<string, mixed> Actual parsed statistics */
    private array $parsedStatistics;

    protected function setUp(): void
    {
        $this->htmlFileName = __DIR__ . '/../data/8daWuo4AAAAJ.html';
        if (! file_exists($this->htmlFileName)) {
            $this->fail('The fixture file does not exist.');
        }
        if (! is_readable($this->htmlFileName)) {
            $this->fail('The fixture file is not readable.');
        }
        if (! is_file($this->htmlFileName)) {
            $this->fail('The fixture file is not a file.');
        }
        if (filesize($this->htmlFileName) === 0) {
            $this->fail('The fixture file is empty.');
        }
        $this->htmlFile = fopen($this->htmlFileName, 'rb');

        $this->parsedStatistics = [
            'sinceYear' => '2014',
            'nbCitations' => '1338',
            'nbCitationsSince' => '1149',
            'hIndex' => '17',
            'hIndexSince' => '16',
            'i10Index' => '21',
            'i10IndexSince' => '21',
            'nbCitationsPerYear' => [
                '2009' => '6',
                '2010' => '25',
                '2011' => '44',
                '2012' => '54',
                '2013' => '56',
                '2014' => '99',
                '2015' => '128',
                '2016' => '243',
                '2017' => '248',
                '2018' => '348',
                '2019' => '83',
            ]
        ];
    }

    protected function tearDown(): void
    {
        if (is_resource($this->htmlFile)) {
            fclose($this->htmlFile);
        }
    }

    /**
     * @covers \GScholarProfileParser\Parser\StatisticsParser
     */
    public function testParse(): void
    {
        $statisticsParser = $this->createUnitUnderTest();

        $this->assertSame($this->parsedStatistics, $statisticsParser->parse());
    }

    private function createUnitUnderTest(): StatisticsParser
    {
        return new StatisticsParser($this->createTestCrawler());
    }

    private function createTestCrawler(): Crawler
    {
        $content = fread($this->htmlFile, filesize($this->htmlFileName));
        $crawler = new Crawler();
        $crawler->addContent($content, 'text/html; charset=ISO-8859-1');

        return $crawler;
    }
}
