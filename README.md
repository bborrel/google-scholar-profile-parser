# Google Scholar Profile Parser

[![Latest Stable Version](https://poser.pugx.org/bborrel/google-scholar-profile-parser/v/stable)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![Minimum PHP Version](https://img.shields.io/packagist/php-v/bborrel/google-scholar-profile-parser.svg?maxAge=3600)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![Total Downloads](https://poser.pugx.org/bborrel/google-scholar-profile-parser/downloads)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![License](https://poser.pugx.org/bborrel/google-scholar-profile-parser/license)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)

[![Tested on PHP 7.2 to 8.3](https://img.shields.io/badge/tested%20on-PHP%207.2%20|%207.3%20|%207.4%20|%208.0%20|%208.1%20|%208.2%20|%208.3-brightgreen.svg?maxAge=2419200)](https://travis-ci.com/bborrel/google-scholar-profile-parser)
[![Build Status](https://app.travis-ci.com/bborrel/google-scholar-profile-parser.svg?token=GRFWf5QKer9Sw41QTo4e&branch=main)](https://app.travis-ci.com/bborrel/google-scholar-profile-parser)
[![Coverage Status](https://coveralls.io/repos/github/bborrel/google-scholar-profile-parser/badge.svg?branch=master)](https://coveralls.io/github/bborrel/google-scholar-profile-parser?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fbborrel%2Fgoogle-scholar-profile-parser%2Fmain)](https://dashboard.stryker-mutator.io/reports/github.com/bborrel/google-scholar-profile-parser/main)
[![Maintainability](https://api.codeclimate.com/v1/badges/a99a88d28ad37a79dbf6/maintainability)](https://codeclimate.com/github/codeclimate/codeclimate/maintainability)

Google Scholar Profile Parser is a PHP library which parses the HTML of a scholar's profile page from Google Scholar 
website and transforms its data into a regular PHP data structure.

The parsed data from a scholar is:

- his/her list of publications (title, link, authors, publisher details, citations)
- his/her citations' statistics (number of citations, h-index, i10-index)

## Table of content

- [Project Rationale](#project-rationale)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Versioning](#versioning)
- [Code Quality](#code-quality)
- [Author](#author)
- [License](#license)

## Project Rationale

As explained by this [Wikipedia page][1]:

> Google Scholar is a freely accessible web search engine that indexes the full text or metadata of scholarly literature
> across an array of publishing formats and disciplines.Google Scholar is a website which indexes scholars' publications
> and citations.

Unfortunately [Google Scholar][2] website doesn't provide an API and I needed a way to fetch a scholar's data.

So, while I was looking for a PHP library which parses a profile page from Google Scholar website, I only found 
[Scholar parser][3] from [Daniel Schreij][4]. But I was unhappy with this library's dependency upon [PhantomJS][5] 
which development is suspended (and will likely not resume, leaving users without support). So I decided to rewrite this
library redesigning it to depend only on PHP, and no more Javascript.

## Requirements

Major versions vs. PHP:
- 3.x: PHP 8.1+
- 2.x: PHP 7.1+
- 1.x: PHP 5.6+

As stated in [composer.json][6], it requires PHP extension DOM.

## Installation

Use [Composer][7] to download and install this library as well as its dependencies.

```bash
composer require bborrel/google-scholar-profile-parser
```

## Usage

See the examples in the [library's documentation][8].

## Versioning

This library use [SemVer][9] for versioning. For available versions, see the [tags on this repository][10]. For feature
changes, see the [CHANGELOG.md][11] file for details.

## Code Quality

The code of this library:

- follows the [PSR-1][12] and [PSR-12][13] coding standards
- follows the [PSR-4][14] autoloading standard
- is statically analysed with [PHPQA][15] (which wraps several tools, notably [PHPCS][16], [PHPMD][17], [PHPStan][18] 
and [Psalm][19]), and by Code Climate (which is setup with plugins [Phan][20], [PHPMD][17], [SonarPHP][21])
- is unit tested with [PHPUnit][22] (code coverage on [Coveralls][23])
- is mutation tested with [Infection][24]
- is tested for compatibility with different versions of PHP (see [.travis.yml][25] for details)
- has its dependencies checked for known security issues by [Packagist API][26]
- is continuously integrated on [TravisCI][27]

These tools are installed with the library as long as you do not specify the option `--no-dev` when running the 
`install` or `update` [Composer][7] commands.

To run the static analysis tools and the unit tests via [PHPQA][15]:

```bash
./vendor/bin/phpqa
```

To see the reports generated by [PHPQA][15] use a browser to open the file `./build/phpqa.html`. 

## Author

[Benoit Borrel][28]

## License

This library is licensed under the GPL-3.0-only License, see the [LICENSE.md][29] file for details.

[1]: https://en.wikipedia.org/wiki/Google_Scholar
[2]: https://scholar.google.com/
[3]: https://github.com/dschreij/scholar_parser
[4]: https://github.com/dschreij
[5]: http://phantomjs.org/
[6]: composer.json
[7]: https://getcomposer.org/
[8]: doc
[9]: http://semver.org/
[10]: https://github.com/bborrel/google-scholar-profile-parser/tags
[11]: CHANGELOG.md
[12]: https://www.php-fig.org/psr/psr-1/
[13]: https://www.php-fig.org/psr/psr-12/
[14]: https://www.php-fig.org/psr/psr-4/
[15]: https://github.com/EdgedesignCZ/phpqa
[16]: https://github.com/squizlabs/PHP_CodeSniffer
[17]: https://phpmd.org/
[18]: https://github.com/phpstan/phpstan
[19]: https://psalm.dev/
[20]: https://github.com/phan/phan
[21]: https://www.sonarsource.com/products/codeanalyzers/sonarphp.html
[22]: https://phpunit.de/
[23]: https://coveralls.io/github/bborrel/google-scholar-profile-parser?branch=master
[24]: https://github.com/infection/infection
[25]: .travis.yml
[26]: https://packagist.org/apidoc#list-security-advisories
[27]: https://travis-ci.com/bborrel/google-scholar-profile-parser
[28]: https://github.com/bborrel
[29]: LICENSE.md
