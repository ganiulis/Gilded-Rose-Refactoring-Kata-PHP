[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

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

Source: https://trunkbaseddevelopment.com/

## Installation

### Requirements

This project needs Docker Desktop and Git:

- [Git](https://git-scm.com/downloads) - version control
- [Docker Desktop](https://www.docker.com/products/docker-desktop) - containerization

The kata itself uses:

- [Composer](https://getcomposer.org) - PHP dependency manager
- [PHP 8.0 FPM](https://www.php.net/downloads.php) - see [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP 8.0

Both of which are installed through Docker.

### Instructions

#### Docker

Clone the repository using `git`:

```shell script
git clone https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP
```

Build Docker container using `docker-compose`:

```shell script
docker-compose up -d --build
```

The `-d` command option enables *Detached* mode: runs containers in the background and prints new container names. The `--build` command option builds images before starting the containers.

Source: https://docs.docker.com/compose/reference/up/

Check if the container images have succesfully installed:

```shell script
docker ps
```

#### PHP CLI

Launch the `php-fpm` CLI in Docker and install the required PHP dependencies using `composer`:

```shell script
composer install
```

You are now able to play around with how the code works through the `php-fpm` CLI.

Create the schema for the database using a pre-made script once more through `composer` and press enter once it prompts whether you want to make any changes to the database's schema:

```shell script
composer create-schema
```

If you want to terminate the Docker container:

```shell script
docker-compose down
```

#### Adminer interface

You can also access the MariaDB database via the default [Adminer localhost](http://localhost:8080/) while the Docker container is running. Log in with `admin` and `password`.

## Container Images

This project uses `docker-compose` to set up these images:
- [PHP 8.0 FPM](https://hub.docker.com/_/php/) with [Composer 2.1](https://hub.docker.com/_/composer) - see [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP 8.0
    - `git`, `zip` and `unzip` are installed along with the image
    - `pdo` and `pdo_mysql` are installed to work along with `MariaDB 10.7.1`
- [MariaDB 10.7.1](https://hub.docker.com/_/mariadb) - an open source relational database forked from MySQL which is licensed under the [GNU General Public License](https://www.gnu.org/licenses/gpl-3.0.html) and offers better performance than MySQL
- [Adminer latest](https://hub.docker.com/_/adminer) - (formerly phpMinAdmin) a light-weight database management alternative to [phpMyAdmin](https://hub.docker.com/_/phpmyadmin) which provides similar functionality and consists of a single file ready to deploy to the target server

## Dependencies

This project uses `composer install` to install these dev dependencies:
- [Symfony](https://symfony.com/) - a PHP framework primarily used to create websites and web applications. Built on top of the fantastic set of decoupled [Symfony Components](https://symfony.com/components) PHP libraries
- [Doctrine](https://www.doctrine-project.org/) - a set of PHP libraries primarily focused on database storage and object mapping. The core projects of Doctrine are the [Object Relational Mapper](https://www.doctrine-project.org/projects/orm.html) and the [Database Abstraction Layer](https://www.doctrine-project.org/projects/dbal.html) which work in tandem with the Symfony framework
- [PHPUnit](https://phpunit.de/) - unit testing framework
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php) - assertion and verification library to aid unit testing
- [PHPStan](https://github.com/phpstan/phpstan) - finds code errors without needing to run any code beforehand
- [Easy Coding Standard](https://github.com/symplify/easy-coding-standard) - checks code and applies a defined coding standard
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki) - detects and automatically corrects violations of a defined coding standard

## File & Folder Structure

- `app/` - main code lives here
    - `bin/console` - Symfony Console component entrypoint
    - `config/` - contains yaml configuration files
    - `migrations/` - any changes to the database schema are created here as PHP scripts via `php bin/console make:migration` or `composer create-schema` console commands
    - `src/` - source folder refactored to support Symfony
    - `tests/` - contains all code tests for `src/`. Aims at 95% file coverage
- `docker/` - categorized `Dockerfile` files live here
- `docker-compose.yml` - main `docker-compose` file

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

Easy Coding Standard is configured for style and code standards as described by the [PSR-12](https://www.php-fig.org/psr/psr-12/) specification.

Source: https://www.php-fig.org/psr/psr-12/

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
