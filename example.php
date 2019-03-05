<?php

require __DIR__ . '/vendor/autoload.php';

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use GScholarProfileParser\Parser\PublicationParser;
use GScholarProfileParser\Entity\Publication;
use Goutte\Client;

/** @var Client $client */
$client = new Client();

/** @var ProfilePageCrawler $crawler */
$crawler = new ProfilePageCrawler($client, '8daWuo4AAAAJ');

/** @var PublicationParser $parser */
$parser = new PublicationParser($crawler->getCrawler());

$publications = $parser->parse();
foreach ($publications as &$publication) {
    $publication = new Publication($publication);
}
unset($publication);
