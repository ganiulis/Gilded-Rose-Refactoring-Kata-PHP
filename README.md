[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

![logo](logo.png)

# Gilded Rose Kata - PHP Version

My own take on the PHP version of the Gilded Rose Refactoring Kata exercise.

See the [original readme](https://github.com/emilybache/GildedRose-Refactoring-Kata/blob/main/README.md) for general information regarding this exercise.

Built on top of [Symfony 5](https://symfony.com/) along with [MariaDB 10.7.1](https://mariadb.org/).

## Table of Contents
* [Gilded Rose Requirements Specification](#gilded-rose-requirements-specification)
* [PHP](#php)
    + [PHP-FPM](#php-fpm)
* [Symfony](#symfony)
* [MariaDB](#mariadb)
* [NGINX](#nginx)
* [Adminer](#adminer)
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

## PHP

I've been working with PHP as a back-end language for several months now and built a few personal and private websites which include PHP in their code. It does its job and has some neat associated frameworks like [Symfony](https://symfony.com/) and [Laravel](https://laravel.com/).

This kata uses [version 8.0](https://www.php.net/releases/8.0/en.php) of [PHP-FPM](https://www.php.net/manual/en/intro.fpm.php). See the section for [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP.

### PHP-FPM

This project specifically uses the [PHP 8.0 FastCGI Process Manager](https://www.php.net/manual/en/intro.fpm.php). It's an alternative to regular PHP 8.0+ as PHP-FPM is faster than traditional CGI-based methods and can handle heavier loads, which is useful for high-traffic websites and systems.[^1] Not essential, but nice to have.

### Symfony

[Symfony](https://symfony.com/) is a PHP framework primarily used to create websites and web applications. Built on top of the fantastic set of decoupled [Symfony Components](https://symfony.com/components) PHP libraries.

This framework is slightly more complicated to set up and work with when compared to its competitor [Laravel](https://laravel.com/), but offers more flexibility and better adaptability for PHP applications in the long-run.

This kata uses [version 5](https://symfony.com/5) of the [PHP](#php) framework.

### MariaDB

[MariaDB](https://mariadb.org/) is an open source relational database forked from MySQL. MariaDB is licensed under the [GNU General Public License](https://www.gnu.org/licenses/gpl-3.0.html) and offers better performance than MySQL.[^2]

This kata uses [version 10.7.1](https://mariadb.com/kb/en/mariadb-1071-release-notes/) of the database.

### NGINX

[NGINX](https://www.nginx.com/) (pronounced "engine-x") is an open source reverse proxy server for HTTP, HTTPS, SMTP, POP3 and IMAP protocols, as well as a load balancer, HTTP cache, and a web (origin) server.[^3]

NGINX started with a strong focus on high concurrency, high performance and low memory usage.

It is licensed under the 2-clause BSD-like license and runs on Linux, BSD variants, Mac OS X, Solaris, AIX, HP-UX, as well as other *nix flavors. It also has a proof of concept port for Microsoft Windows.

The purpose of NGINX is to address the performance limitations of typical Apache web servers and has so far been steadily gaining popularity as a higher-performance alternative to Apache over the past decade.[^4]

This kata uses [version 1.21.4](https://nginx.org/en/CHANGES) of the server.

### Adminer

Not relevant for the current iteration of this kata. Might be re-used later, therefore this section is left unremoved for the time being.

~~[Adminer](https://www.adminer.org/) (formerly phpMinAdmin) is a light-weight database management tool. It serves as an alternative to [phpMyAdmin](https://www.phpmyadmin.net/) which provides similar functionality and consists of a single file ready to deploy to the target server.~~

~~Taken from Adminer's [landing page](https://www.adminer.org/):~~
> ~~Replace phpMyAdmin with Adminer and you will get a tidier user interface, better support for MySQL features, higher performance and more security.~~

~~This kata uses the latest version of Adminer.[^5]~~

## Version Control Development Model

This project follows the Trunk-Based Development model.

![git branch workflow](https://trunkbaseddevelopment.com/trunk1c.png)

For this project, [main](https://github.com/ganiulis/Gilded-Rose-Refactoring-Kata-PHP/tree/main) is the Trunk branch.

### Why Trunk-Based Development?

This model is easier to set up and iterate when the project team is small (i.e. it's only me who's working on it).[^6]

## Installation

### Requirements

This project needs Docker Desktop and Git:

- [Git](https://git-scm.com/downloads) - version control
- [Docker Desktop](https://www.docker.com/products/docker-desktop) - containerization

The kata itself uses:

- ~~[Adminer](https://hub.docker.com/_/adminer) - see the section for [Adminer](#adminer) for reasons behind using this~~ not used for now
- [Composer](https://getcomposer.org) - PHP dependency manager
- [MariaDB](https://hub.docker.com/_/mariadb) - see the section for [MariaDB](#mariadb) for reasons behind using this
- [NGINX](https://hub.docker.com/_/nginx) - see the section for [NGINX](#nginx) for reasons behind using this
- [PHP-FPM](https://hub.docker.com/_/php) - see the section for [PHP-FPM](#php-fpm) for reasons behind using this instead of regular PHP
- [Symfony](https://symfony.com/) - see the section for [Symfony](#symfony) for reasons behind using this

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

The `-d` command option enables *Detached* mode: runs containers in the background and prints new container names. The `--build` command option builds images before starting the containers.[^7]

Check if the container images have succesfully installed:

```shell script
docker ps
```

If you want to terminate the Docker container:

```shell script
docker-compose down
```

#### PHP CLI

Launch the `php-fpm` CLI in Docker and install the required PHP dependencies using `composer`:

```shell script
composer install
```

You are now able to play around with how the code works through the `php-fpm` CLI.

Create the schema for the database using a pre-made script once more through `composer` and press enter once it prompts whether you want to make any changes to the schema of the database:

```shell script
composer create-schema
```

You can also run the current fixture summary script as well:

```shell script
php bin/console app:fixtures:print [-d days]
```

#### Adminer interface

Not used for now.

~~You can also access the MariaDB database via the default [Adminer localhost](http://localhost:8080/) while the Docker container is running. Log in with `admin` and `password`.~~

## Container Images

This project uses `docker-compose` to set up these images:
- [PHP 8.0 FPM](https://hub.docker.com/_/php/) with [Composer 2.1](https://hub.docker.com/_/composer) - see [PHP-FPM](#php-fpm) for reasons behind using this instead of PHP
    - `git`, `zip` and `unzip` are installed along with the image
    - `pdo` and `pdo_mysql` are installed to work along with [MariaDB 10.7.1](https://hub.docker.com/_/mariadb) ~~and [Adminer latest](https://hub.docker.com/_/adminer)~~
- [MariaDB 10.7.1](https://hub.docker.com/_/mariadb) - see the section for [MariaDB](#mariadb) for reasons behind using this
- [NGINX 1.21.4](https://hub.docker.com/_/nginx) - see the section for [NGINX](#nginx) for reasons behind using this
- ~~[Adminer latest](https://hub.docker.com/_/adminer) - see the section for [Adminer](#adminer) for reasons behind using this~~ not used for now

## Dependencies

This project uses `composer install` to install these dev dependencies:
- [Symfony](https://symfony.com/) - see the section for [Symfony](#symfony) for reasons behind using this
- [Doctrine](https://www.doctrine-project.org/) - a set of PHP libraries primarily focused on database storage and object mapping. The core projects of Doctrine are the [Object Relational Mapper](https://www.doctrine-project.org/projects/orm.html) and the [Database Abstraction Layer](https://www.doctrine-project.org/projects/dbal.html) which both work in tandem with [Symfony](https://symfony.com/). For the purposes of this kata, Doctrine ORM is used to set up the schema for the [MariaDB](#mariadb) `gildedrose` database with the help of [XML mapping](https://www.doctrine-project.org/projects/doctrine-orm/en/2.10/reference/xml-mapping.html) once the `composer create-schema` command is issued
- [PHPUnit](https://phpunit.de/) - unit testing framework. Testing aims for 95% code coverage
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php) - assertion and verification library to aid unit testing
- [PHPStan](https://github.com/phpstan/phpstan) - finds code errors without needing to run any code beforehand
- [Easy Coding Standard](https://github.com/symplify/easy-coding-standard) - checks code and applies a defined coding standard
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/wiki) - detects and automatically corrects violations of a defined coding standard

## File & Folder Structure

- `app/` - main code lives here
    - `bin/console` - Symfony Console component entrypoint
    - `config/` - contains `.yaml` and `.xml` project configuration files
    - `public/` - entrypoint for 
    - `migrations/` - any changes to the database schema are created here as PHP scripts via `php bin/console make:migration` or `composer create-schema` console commands
    - `src/` - source folder refactored to support Symfony
    - `tests/` - contains all code tests for `src/`. Aims for 95% code coverage
- `docker/` - categorized `Dockerfile` files live here
- `docker-compose.yml` - main `docker-compose` file

This structure does not include all files and folders, only ones which are relevant for the purposes of showcasing this kata.

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

Easy Coding Standard is configured for style and code standards as described by the [PSR-12](https://www.php-fig.org/psr/psr-12/) specification.[^8]

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

[^1]: [Difference between PHP-CGI and PHP-FPM](https://www.basezap.com/difference-php-cgi-php-fpm/)
[^2]: [MariaDB vs MySQL: What is the Difference Between MariaDB and MySQL?](https://www.guru99.com/mariadb-vs-mysql.html)
[^3]: [Docker Hub: What is nginx?](https://hub.docker.com/_/nginx)
[^4]: [Nginx vs Apache: Web Server Showdown](https://kinsta.com/blog/nginx-vs-apache/)
[^5]: Footnote: Adminer does not conflict with other parts of the kata regardless of the version.
[^6]: [Trunk Based Development: Introduction](https://trunkbaseddevelopment.com/)
[^7]: [`docker-compose up` specificaton](https://docs.docker.com/compose/reference/up/)
[^8]: [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)
