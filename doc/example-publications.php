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

$publications = $parser->parse();

// hydrates array[] into array[Publication]
foreach ($publications as &$publication) {
    /** @var Publication $publication */
    $publication = new Publication($publication);
}
unset($publication);

// displays latest publication data
echo $publications[0]->getTitle(), "\n";
echo $publications[0]->getPublicationURL(), "\n";
echo $publications[0]->getAuthors(), "\n";
echo $publications[0]->getPublisherDetails(), "\n";
echo $publications[0]->getNbCitations(), "\n";
echo $publications[0]->getCitationsURL(), "\n";
echo $publications[0]->getYear(), "\n";

/** @var PublicationYearFilterIterator $publications2018 */
$publications2018 = new PublicationYearFilterIterator(new ArrayIterator($publications), 2018);

// displays list of publications published in 2018
foreach ($publications2018 as $publication) {
    echo $publication->getTitle(), "\n";
    echo $publication->getPublicationURL(), "\n";
    echo $publication->getAuthors(), "\n";
    echo $publication->getPublisherDetails(), "\n";
    echo $publication->getNbCitations(), "\n";
    echo $publication->getCitationsURL(), "\n";
    echo $publication->getYear(), "\n";
}
