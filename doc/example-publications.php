<?php

require __DIR__ . '/../vendor/autoload.php';

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
use GScholarProfileParser\Iterator\PublicationYearFilterIterator;
use GScholarProfileParser\Parser\PublicationParser;
use GScholarProfileParser\Entity\Publication;
use Goutte\Client;

/** @var Client $client */
$client = new Client();

/** @var ProfilePageCrawler $crawler */
$crawler = new ProfilePageCrawler($client, '8daWuo4AAAAJ'); // the second parameter is the scholar's profile id

/** @var PublicationParser $parser */
$parser = new PublicationParser($crawler->getCrawler());

/** @var array<int, array<string, string>> $publications */
$publications = $parser->parse();

// hydrates items of $publications into Publication
foreach ($publications as &$publication) {
    /** @var Publication $publication */
    $publication = new Publication($publication);
}
unset($publication);

/** @var Publication $latestPublication */
$latestPublication = $publications[0];

// displays latest publication data
echo $latestPublication->getTitle(), "\n";
echo $latestPublication->getPublicationURL(), "\n";
echo $latestPublication->getAuthors(), "\n";
echo $latestPublication->getPublisherDetails(), "\n";
echo $latestPublication->getNbCitations(), "\n";
echo $latestPublication->getCitationsURL(), "\n";
echo $latestPublication->getYear(), "\n";

/** @var PublicationYearFilterIterator $publications2018 */
$publications2018 = new PublicationYearFilterIterator(new ArrayIterator($publications), 2018);

// displays list of publications published in 2018
/** @var Publication $publication */
foreach ($publications2018 as $publication) {
    echo $publication->getTitle(), "\n";
    echo $publication->getPublicationURL(), "\n";
    echo $publication->getAuthors(), "\n";
    echo $publication->getPublisherDetails(), "\n";
    echo $publication->getNbCitations(), "\n";
    echo $publication->getCitationsURL(), "\n";
    echo $publication->getYear(), "\n";
}
