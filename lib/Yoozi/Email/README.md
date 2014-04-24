email
=====

> This library is part of [Project Golem](http://golem.yoozi.cn/), see [yoozi/golem](https://github.com/yoozi/golem) for more info.

PHP libraries to help processing email related tasks, such as a Email Address Parser and etc.

## Installation

The best and easy way to install the Golem package is with [Composer](https://getcomposer.org).

1. Open your composer.json and add the following to the require array:

    ```
    "yoozi/miner": "1.0.*"
    ```

2. Run Composer to install or update the new package dependencies.

    ```
    php composer install
    ```

    or

    ```
    php composer update
    ```

## Usage

### Email Address Parser

We can use this Parser class to parse an email address.

```php
<?php

use Yoozi\Email\Address\Parser;

$email = 'user@gmail.com';
$parts = $this->parser->parse($email);

var_dump($meta);
```

Data returned:

```php
array(5) {
  ["email"]=>
  string(18) "user@gmail.com"
  ["local"]=>
  string(8) "user"
  ["domain"]=>
  string(9) "gmail.com"
  ["url"]=>
  string(22) "http://mail.google.com"
  ["listed"]=>
  bool(true)
}
```

* email: The email address we are currently parsing.
* local: Local part of this address.
* domain: Domain name of this address.
* url: Url for users to log into the email service.
* listed: Whether this address is listed in the thrid-party email service provider whitelist.