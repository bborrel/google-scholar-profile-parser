<?php

/**
 * @file
 */

namespace GScholarProfileParser\DomCrawler;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Crawls a Google Scholar profile page.
 */
class ProfilePageCrawler
{

    const GSCHOLAR_SCHEME = 'https';
    const GSCHOLAR_HOSTNAME = 'scholar.google.com';

    /** @var Crawler crawler */
    private $crawler;

    /**
     * @param Client $client
     * @param string $profileId
     */
    public function __construct(Client $client, /* string */ $profileId)
    {
        $url = sprintf(
            '%s://%s/citations?user=%s&pagesize=1000&sortby=pubdate&hl=en',
            self::GSCHOLAR_SCHEME,
            self::GSCHOLAR_HOSTNAME,
            $profileId
        );

        $this->crawler = $client->request('GET', $url);
    }

    /**
     * @return Crawler
     */
    public function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * @return string
     */
    public static function getSchemeAndHostname()
    {
        return self::GSCHOLAR_SCHEME . '://' . self::GSCHOLAR_HOSTNAME;
    }
}
