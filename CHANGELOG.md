# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][1], and this project adheres to [Semantic Versioning][2].

## [1.1.3] - 2019-06-01
### Added
- Unit tests for entities Publication and Statistics.
- Mutation tests with Infection.
- Configuration of Continuous Integration with Travis-CI, running:
-- unit tests with code coverage published on Coveralls, 
-- check of code's compatibility with different PHP versions,
-- check of dependencies security flaws.
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
