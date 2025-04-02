# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][1], and this project adheres to [Semantic Versioning][2].

## [TBD] - TBD
### Changed
- Composer: relax version constraints on Symfony http-client + browser-kit
- Travis: switch to PHP 8.1, PHP 8.2 and PHP 8.3
- PHPUnit: refactor unit tests
- README.md: update 'tested on' badge with PHP 8.2 and PHP 8.3, fix 'build status' badge

## [3.0.0] - 2025-02-11
### Changed
- Composer: bump PHP from >=7.4 to >=8.1
- Dev dependencies: upgrade to latest versions compatible with PHP 8.1
- Replace fabpot/goutte 4 with Symfony http-client + browser-kit
### Added
- Use Editor Config

## [2.2.0] - 2025-02-05
### Changed
- fabpot/goutte: upgrade from 3.3.1 to 4.0.3
- Dev dependencies: upgrade to latest versions compatible with PHP 7.4
- Rename branch master into main

## [2.1.0] - 2021-08-04
### Changed
- Composer: upgrade dev dependencies for Composer 2
- Travis: add support of xDebug 3 and PHP 7.4
### Fixed
- Parsing of publication URL following modification from Google Scholar (issue #3)

## [2.0.1] - 2019-09-27
### Added
- Static analysis by Code Climate (setup with plugins Phan, PHPMD and SonarPHP).

## [2.0.0] - 2019-09-11
### Changed
- Migrate code from PHP 5.6 to PHP 7.1 by specifying methods arguments and returns types.

## [1.1.4] - 2019-09-06
### Added
- Static analysis tools wrapped by phpQA (PHPMetrics, PHPLOC, PHPCS, PHPMD, PDepend, PHPCPD, PHPStan and Psalm) with
  additional PHPCS coding standards (ObjectCalisthenics, PHPCompatibility, Security).
### Fixed
- Fix example code in example-statistics.php.

## [1.1.3] - 2019-06-01
### Added
- Unit tests for entities Publication and Statistics.
- Mutation tests with Infection.
- Configuration of Continuous Integration with Travis-CI, running:
  - Unit tests with code coverage published on Coveralls, 
  - Check of code's compatibility with different PHP versions,
  - Check of dependencies security flaws.
- Badges in README.md.

## [1.1.2] - 2019-03-25
### Added
- Filters out parsed publications with non unique title (a.k.a duplicated ones).
- PHPUnit configuration file.

## [1.1.1] - 2019-03-09
### Added
- Filter iterator to filters in publications published a specified year.

## [1.1.0] - 2019-03-08
### Added
- Parsing of a scholar profile's statistics.

## [1.0.2] - 2019-03-08
### Added
- Publication entity's getter method getPublicationURL().
### Changed
- Publication entity's property gScholarPath renamed into publicationPath.

## [1.0.1] - 2019-03-05
### Added
- Publication entity's getter methods for all its private properties.

## [1.0.0] - 2019-03-04
### Added
- Parsing of a scholar profile's publications.

[1]: https://keepachangelog.com/en/1.0.0
[2]: https://semver.org/spec/v2.0.0.html
