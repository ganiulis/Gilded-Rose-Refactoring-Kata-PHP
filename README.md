# Gilded Rose Kata - PHP Version

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
* [Container Images](#container-images)
* [Dependencies](#dependencies)
* [File & Folder Structure](#file--folder-structure)
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
* [License](#license)

## Gilded Rose Requirements Specification

See the [original requirements text file](https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/GildedRoseRequirements.txt) to check out what exactly is happening with this code.

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

This project needs Composer, Docker Desktop and Git:

- [Composer](https://getcomposer.org) - PHP dependency manager
- [Docker Desktop](https://www.docker.com/products/docker-desktop) - containerization
- [Git](https://git-scm.com/downloads) - version control

The kata itself uses:

- [PHP 8.0 FPM](https://www.php.net/downloads.php) - see [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP 8.0

Both of which are automatically installed through the Docker Desktop container.

### Instructions

Clone the repository using `git`:

```shell script
git clone https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP
```

Install Docker container using `docker-compose`:

```shell script
docker-compose up -d --build
```

The `-d` command option enables *Detached* mode: runs containers in the background and prints new container names. The `--build` command option builds images before starting the containers. Source: [https://docs.docker.com/compose/reference/up/](https://docs.docker.com/compose/reference/up/)

Check if the container images have succesfully installed:

```shell script
docker ps
```

Install the required PHP dependencies using `composer`:

```shell script
cd app && composer update && composer install
```

You are now able to play around with how the code works through the now-running CLI of `php-fpm` in Docker Desktop.

If you want to terminate the Docker container:

```shell script
docker-compose down
```

## Container Images

This project uses `docker-compose` to set up these images:
- [PHP 8.0 FPM](https://hub.docker.com/_/php/) with [Composer 2.1](https://hub.docker.com/_/composer) - see [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP 8.0

## Dependencies

This project uses `composer install` to install these dev dependencies:
- [PHPUnit](https://phpunit.de/) - unit testing framework
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php) - assertion and verification library to aid unit testing
- [PHPStan](https://github.com/phpstan/phpstan) - finds code errors without needing to run any code beforehand
- [Easy Coding Standard](https://github.com/symplify/easy-coding-standard) - checks code and applies a defined coding standard
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki) - detects and automatically corrects violations of a defined coding standard

## File & Folder Structure

- `app/` - main code lives here
    - `fixtures/` - fixtures live here
        - `texttest_fixture.php` - can be used by `ApprovalTests` or alternatively run from a command line
    - `src/` - source folder which contains a few classes
        - `Item.php` - this class should *not* be changed
        - `GildedRose.php` - this class needs to be refactored and the new *'Conjured'* feature added
    - `tests/` - contains all code tests
        - `GildedRoseTest.php` - starter test
            - For more information, see the [PHP version of the Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata/tree/main/php)
        - `approvals/` - contains test data for `ApprovalTests`
- `docker/` - categorized `Dockerfile` files live here
- `docker-compose.yml` - main `docker-compose` file
- `.env` - used in conjunction with `docker-compose.yml` to set `UID` and `GID` to `1000` instead of `root`

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

## License

This project follows the [2.0 version of the Apache License](https://www.apache.org/licenses/LICENSE-2.0).

See the [LICENSE file](https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP/blob/main/LICENSE) for more information.