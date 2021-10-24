# GildedRose Kata - PHP Version

My own take on the PHP version of the Gilded Rose Refactoring Kata exercise.

See the [original readme](https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/README.md) for general information regarding this exercise.

## Table of Contents
  * [Gilded Rose Requirements Specification](#gilded-rose-requirements-specification)
  * [Why PHP?](#why-php)
    + [PHP-FPM](#php-fpm)
  * [Version Control Development Model](#version-control-development-model)
    + [Why Trunk-Based Development?](#why-trunk-based-development)
  * [Installation](#installation)
    + [Requirements](#requirements)
    + [Instructions](#instructions)
  * [Dependencies](#dependencies)
  * [Folders](#folders)
  * [Testing](#testing)
    + [Tests with Coverage Report](#tests-with-coverage-report)
  * [Code Standard](#code-standard)
    + [Check Code](#check-code)
    + [Fix Code](#fix-code)
  * [Static Analysis](#static-analysis)
  * [Issues](#issues)
  * [Projects](#projects)
  * [Wiki](#wiki)
  * [Contact](#contact)

---

## Gilded Rose Requirements Specification

Read the [original requirements text file](https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/GildedRoseRequirements.txt) to check out what exactly is happening with this code.

## Why PHP?

I've been working with PHP as a back-end language for several months now and built a few personal and private websites which include PHP in their code. It does its job and has some neat associated frameworks like [Symfony](https://symfony.com/) and [Laravel](https://laravel.com/).

### PHP-FPM

This project specifically uses the [PHP 8.0 FastCGI Process Manager](https://www.php.net/downloads.php). It's an alternative to regular PHP 8.0+ as [PHP-FPM is faster than traditional CGI-based methods](https://www.basezap.com/difference-php-cgi-php-fpm/) and can handle heavier loads, which is useful for high-traffic websites and systems. Not essential, but nice to have.

## Version Control Development Model

This project follows the Trunk-Based Development model.

![git branch workflow](https://trunkbaseddevelopment.com/trunk1c.png)

For this project, [main](https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP/tree/main) is the Trunk branch.

### Why Trunk-Based Development?

This model is easier to set up and iterate when the project team is small (i.e. it's only me who's working on it).

Source: [https://trunkbaseddevelopment.com/](https://trunkbaseddevelopment.com/)

## Installation

### Requirements

This project needs Git and Docker Desktop:

- [Git](https://git-scm.com/downloads) - version control
- [Docker Desktop](https://www.docker.com/products/docker-desktop) - containerization

The kata itself uses:

- [PHP 8.0 FastCGI Process Manager](https://www.php.net/downloads.php) - see [PHP-FPM](#php-fpm) for reason behind using this instead of regular PHP 8.0
- [Composer](https://getcomposer.org) - PHP dependency manager

Both of which are automatically installed through the Docker Desktop container.

### Instructions

Clone the repository:

```shell script
git clone https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP
```

Install Docker containers via docker-compose:

```shell script
docker-compose up -d --build
```

Check if the containers have succesfully installed:

```shell script
docker ps
```

Launch the PHP CLI via Docker Desktop and install the required dependencies using composer:

```shell script
composer install
```

You are now able to play around with how the code works via the PHP CLI.

## Dependencies

This project uses `composer install` to install these dependencies:
- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki)

## Folders

- `src` - contains the two classes:
    - `Item.php` - this class should not be changed
    - `GildedRose.php` - this class needs to be refactored, and the new feature added
- `tests` - contains the tests
    - `GildedRoseTest.php` - starter test
        - Tip: ApprovalTests has been included as a dev dependency, see the PHP version of
          the [Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata/)
          for an example
- `Fixture`
    - `texttest_fixture.php` this could be used by an ApprovalTests, or run from the command line

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
composer test
```

A Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias pu="composer test"`), the same
PHPUnit `composer test` can be run:

```shell script
pu
```

### Tests with Coverage Report

To run all test and generate a html coverage report run:

```shell script
composer test-coverage
```

The test-coverage report will be created in /builds, it is best viewed by opening /builds/**index.html** in your
browser.

## Code Standard

Easy Coding Standard (ECS) is configured for style and code standards, **PSR-12** is used. The current code is not upto
standard!

### Check Code

To check code, but not fix errors:

```shell script
composer check-cs
``` 

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias cc="composer check-cs"`), the same
PHPUnit `composer check-cs` can be run:

```shell script
cc
```

### Fix Code

ECS provides may code fixes, automatically, if advised to run --fix, the following script can be run:

```shell script
composer fix-cs
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias fc="composer fix-cs"`), the same
PHPUnit `composer fix-cs` can be run:

```shell script
fc
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
composer phpstan
```

On Windows a batch file has been created, like an alias on Linux/Mac (e.g. `alias ps="composer phpstan"`), the same
PHPUnit `composer phpstan` can be run:

```shell script
ps
```

## Issues

Visit the [GitHub issues page](https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP/issues) to see what's planned next for this repository.

## Projects

To be done.

## Wiki

To be done.

## Contact

If you have any questions or want to get in touch with me, send me a message through [ganiulis.com](https://ganiulis.com/).