# Google Scholar Profile Parser

Google Scholar Profile Parser is a PHP library which parses a profile page from Google Scholar website into an array.

## Table of content

- [Genesis](#genesis)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Versioning](#versioning)
- [Author](#author)
- [License](#license)

## Genesis

While I was looking for a PHP library which parses a profile page from Google Scholar website, I only found 
[Scholar parser][1] from [Daniel Schreij][2]. But I was unhappy with this library's dependency upon [PhantomJS][3] 
which development is suspended (and will likely not resume, leaving users without support). So I decided to rewrite this
library redesigning it to depend only on PHP, and no more Javascript.

## Requirements

As stated in [composer.json][4], it requires:

- PHP 5.6+
- PHP DOM extension

## Installation

Use [Composer][5] to download and install it as well as its dependencies.

```bash
composer require bborrel/google-scholar-profile-parser
```

## Usage

```php
require __DIR__ . '/vendor/autoload.php';

use GScholarProfileParser\DomCrawler\ProfilePageCrawler;
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
foreach ($publications as &$publication) {
    $publication = new Publication($publication);
}
unset($publication);

```

## Versioning

I use [SemVer][6] for versioning. For the versions available, see the [tags on this repository][7]. 

## Author

[Benoit Borrel][8]

# License

This project is licensed under the GPL-3.0-only License - see the [LICENSE.md][9] file for details.

[1]: https://github.com/dschreij/scholar_parser
[2]: https://github.com/dschreij
[3]: http://phantomjs.org/
[5]: https://getcomposer.org/
[6]: http://semver.org/
[7]: https://github.com/bborrel/google-scholar-profile-parser/tags
[8]: https://github.com/bborrel
[9]: LICENSE.md
