<?php

require __DIR__ . '/vendor/autoload.php';

use Goutte\Client;
use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use GScholarProfileParser\Entity\Statistics;
use GScholarProfileParser\Parser\StatisticsParser;

/** @var Client $client */
$client = new Client();

/** @var ProfilePageCrawler $crawler */
$crawler = new ProfilePageCrawler($client, '8daWuo4AAAAJ'); // the second parameter is the scholar's profile id

/** @var StatisticsParser $parser */
$parser = new StatisticsParser($crawler->getCrawler());

/** @var Statistics $statistics */
$statistics = new Statistics($parser->parse());

echo sprintf("           All\t%4d\n", $statistics->getSinceYear());
echo sprintf("Citations: %4d\t%4d\n", $statistics->getNbCitations(), $statistics->getNbCitationsPerYear());
echo sprintf("h-index  : %4d\t%4d\n", $statistics->getHIndex(), $statistics->getHIndexSince());
echo sprintf("i10-index: %4d\t%4d\n", $statistics->getI10Index(), $statistics->getI10IndexSince());
echo "\n";

echo implode("\t", array_keys($statistics->getNbCitationsPerYear()));
echo "\n";
echo implode("\t", array_values($statistics->getNbCitationsPerYear()));
echo "\n";
