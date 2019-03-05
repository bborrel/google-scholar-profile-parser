<?php

/**
 * @file
 */

namespace GScholarProfileParser\DomCrawler;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class ProfilePageCrawler
{

    const GSCHOLAR_SCHEME = 'https';
    const GSCHOLAR_HOSTNAME = 'scholar.google.com';
    const GSCHOLAR_PATH = 'citations';

    /** @var Crawler crawler */
    private $crawler;

    /**
     * @param Client $client
     * @param string $profileId
     */
    public function __construct(Client $client, /* string */ $profileId)
    {
        $url = sprintf(
            '%s://%s/%s?user=%s&pagesize=1000&sortby=pubdate',
            self::GSCHOLAR_SCHEME,
            self::GSCHOLAR_HOSTNAME,
            self::GSCHOLAR_PATH,
            $profileId
        );

        $this->crawler = $client->request('GET', $url);
    }

    /**
     * @return Crawler;
     */
    public function getCrawler()
    {
        return $this->crawler;
    }

}
