<?php

require __DIR__ . '/../vendor/autoload.php';


use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use GScholarProfileParser\Entity\Statistics;
use GScholarProfileParser\Parser\StatisticsParser;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/** @var HttpClientInterface $client */
$client = HttpClient::create();

/** @var HttpBrowser $browser */
$browser = new HttpBrowser($client);


/** @var ProfilePageCrawler $crawler */
$crawler = new ProfilePageCrawler($browser, '8daWuo4AAAAJ'); // the second parameter is the scholar's profile id

/** @var StatisticsParser $parser */
$parser = new StatisticsParser($crawler->getCrawler());

/** @var Statistics $statistics */
$statistics = new Statistics($parser->parse());

$nbCitationsPerYear = $statistics->getNbCitationsPerYear();
$sinceYear = $statistics->getSinceYear();

$nbCitationsSinceYear = 0;
foreach ($nbCitationsPerYear as $year => $nbCitations) {
    if ($year >= $sinceYear) {
        $nbCitationsSinceYear += $nbCitations;
    }
}

// display statistics
echo sprintf("           All\t%4d\n", $sinceYear);
echo sprintf("Citations: %4d\t%4d\n", $statistics->getNbCitations(), $nbCitationsSinceYear);
echo sprintf("h-index  : %4d\t%4d\n", $statistics->getHIndex(), $statistics->getHIndexSince());
echo sprintf("i10-index: %4d\t%4d\n", $statistics->getI10Index(), $statistics->getI10IndexSince());
echo "\n";
echo implode("\t", array_keys($nbCitationsPerYear));
echo "\n";
echo implode("\t", array_values($nbCitationsPerYear));
echo "\n";
