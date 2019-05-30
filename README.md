# Google Scholar Profile Parser

[![Latest Stable Version](https://poser.pugx.org/bborrel/google-scholar-profile-parser/v/stable)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![Minimum PHP Version](https://img.shields.io/packagist/php-v/bborrel/google-scholar-profile-parser.svg?maxAge=3600)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![Total Downloads](https://poser.pugx.org/bborrel/google-scholar-profile-parser/downloads)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)
[![License](https://poser.pugx.org/bborrel/google-scholar-profile-parser/license)](https://packagist.org/packages/bborrel/google-scholar-profile-parser)

[![Tested on PHP 7.2 to 7.3](https://img.shields.io/badge/tested%20on-PHP%207.2%20|%207.3%20-brightgreen.svg?maxAge=2419200)](https://travis-ci.com/bborrel/google-scholar-profile-parser)
[![Build Status](https://travis-ci.com/bborrel/google-scholar-profile-parser.svg?branch=master)](https://travis-ci.com/bborrel/google-scholar-profile-parser)
[![Coverage Status](https://coveralls.io/repos/github/bborrel/google-scholar-profile-parser/badge.svg?branch=feature/travis-ci)](https://coveralls.io/github/bborrel/google-scholar-profile-parser?branch=feature/travis-ci)

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
- [Author](#author)
- [License](#license)

## Project rationale

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

As stated in [composer.json][6], it requires:

- PHP 5.6+
- PHP DOM extension

## Installation

Use [Composer][7] to download and install it as well as its dependencies.

```bash
composer require bborrel/google-scholar-profile-parser
```

## Usage

See the examples in the [project's documentation][8].

## Versioning

This project use [SemVer][9] for versioning. For available versions, see the [tags on this repository][10]. For feature
changes, see the [CHANGELOG.md][11] file for details.
 

## Author

[Benoit Borrel][12]

## License

This project is licensed under the GPL-3.0-only License, see the [LICENSE.md][13] file for details.

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
[12]: https://github.com/bborrel
[13]: LICENSE.md
