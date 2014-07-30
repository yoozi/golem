Project Golem
=====

[![Build Status](https://travis-ci.org/yoozi/golem.svg)](https://travis-ci.org/yoozi/golem)
[![Latest Stable Version](https://poser.pugx.org/yoozi/golem/v/stable.png)](https://packagist.org/packages/yoozi/golem)
[![Code Coverage](https://scrutinizer-ci.com/g/yoozi/golem/badges/coverage.png?s=2d6a059e02254350da07c997aaf711060837abaa)](https://scrutinizer-ci.com/g/yoozi/golem/)
[![Latest Unstable Version](https://poser.pugx.org/yoozi/golem/v/unstable.png)](https://packagist.org/packages/yoozi/golem)
[![License](https://poser.pugx.org/yoozi/golem/license.png)](https://packagist.org/packages/yoozi/golem)

## What is Project Golem?

Project Golem is a PHP development toolkit crafted by R&D team from Yoozi Inc. It consists of a growing collection of loosely coupled high-level PHP libraries, most of which are derived from our own products to solve real world problems.

* [Miner](https://github.com/yoozi/miner): Miner is a PHP library that extracting metadata and interesting text content (like author, summary, and etc.) from HTML pages. It acts like a simplified HTML metadata parser in Apache Tika. 
* [Email](https://github.com/yoozi/email): Simple toolkits to help processing email related tasks, such as a Email Address Parser and etc.
* [Notification](https://github.com/yoozi/notification): A simple library to wrap common notification transports, such as email, socket.io and etc.

Golem can be installed as a whole package via Composer. However, to keep dependency and installation footprint as low as possible, each library within Golem can also be installed as a standalone package.

## System Requirements

* PHP >= 5.3.0
* You will need [Composer](https://getcommposer.org/) installed to load the dependencies of Golem libraries.
* Some libraries may require extra server components and/or extensions installed.

## Installation

The best and easy way to install the Golem package is via Composer.

1. Open your composer.json and add the following to the require array:

    ```
    "yoozi/golem": "1.0.*"
    ```

2. Run Composer to install or update the new package dependencies.

    ```
    php composer install
    ```

    or

    ```
    php composer update
    ```

## Versioning

For transparency and insight into our release cycle, releases will be numbered with the follow format:

```
<major>.<minor>.<patch>
```

And constructed with the following guidelines:

* Breaking backwards compatibility bumps the major
* New additions without breaking backwards compatibility bumps the minor
* Bug fixes and misc changes bump the patch

For more information on semantic versioning, please visit [http://semver.org/](http://semver.org/).

## Testing

To run the tests you first need to install [PHPUnit](http://phpunit.de/).

```
$ phpunit
```

## Changelog

See changelogs [here](https://github.com/yoozi/golem/blob/master/CHANGELOG.md).

## Authors

See authors and contributors [here](https://github.com/yoozi/golem/graphs/contributors).

## License

Copyright 2014 Yoozi, Inc.

Licensed under the [MIT License](https://github.com/yoozi/golem/blob/master/LICENSE).