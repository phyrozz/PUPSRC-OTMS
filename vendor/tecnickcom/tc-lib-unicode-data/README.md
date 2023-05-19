# tc-lib-unicode-data
*PHP library containing UTF-8 font definitions*

[![Latest Stable Version](https://poser.pugx.org/tecnickcom/tc-lib-unicode-data/version)](https://packagist.org/packages/tecnickcom/tc-lib-unicode-data)
[![Master Build Status](https://secure.travis-ci.org/tecnickcom/tc-lib-unicode-data.png?branch=main)](https://travis-ci.org/tecnickcom/tc-lib-unicode-data?branch=main)
[![Master Coverage Status](https://coveralls.io/repos/tecnickcom/tc-lib-unicode-data/badge.svg?branch=main&service=github)](https://coveralls.io/github/tecnickcom/tc-lib-unicode-data?branch=main)
[![License](https://poser.pugx.org/tecnickcom/tc-lib-unicode-data/license)](https://packagist.org/packages/tecnickcom/tc-lib-unicode-data)
[![Total Downloads](https://poser.pugx.org/tecnickcom/tc-lib-unicode-data/downloads)](https://packagist.org/packages/tecnickcom/tc-lib-unicode-data)

[![Donate via PayPal](https://img.shields.io/badge/donate-paypal-87ceeb.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=GBP&business=paypal@tecnick.com&item_name=donation%20for%20tc-lib-unicode-data%20project)
*Please consider supporting this project by making a donation via [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&currency_code=GBP&business=paypal@tecnick.com&item_name=donation%20for%20tc-lib-unicode-data%20project)*

* **category**    Library
* **package**     \Com\Tecnick\Unicode\Data
* **author**      Nicola Asuni <info@tecnick.com>
* **copyright**   2011-2022 Nicola Asuni - Tecnick.com LTD
* **license**     http://www.gnu.org/copyleft/lesser.html GNU-LGPL v3 (see LICENSE.TXT)
* **link**        https://github.com/tecnickcom/tc-lib-unicode-data
* **SRC DOC**     https://tcpdf.org/docs/srcdoc/tc-lib-unicode-data

## Description

PHP library containing UTF-8 font definitions.

The initial source code has been derived from [TCPDF](<http://www.tcpdf.org>).


## Getting started

First, you need to install all development dependencies using [Composer](https://getcomposer.org/):

```bash
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
```

This project include a Makefile that allows you to test and build the project with simple commands.
To see all available options:

```bash
make help
```

To install all the development dependencies:

```bash
make deps
```

## Running all tests

Before committing the code, please check if it passes all tests using

```bash
make qa
```

All artifacts are generated in the target directory.


## Example

Examples are located in the `example` directory.

Start a development server (requires PHP 5.4) using the command:

```
make server
```

and point your browser to <http://localhost:8000/index.php>


## Installation

Create a composer.json in your projects root-directory:

```json
{
    "require": {
        "tecnickcom/tc-lib-unicode-data": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:tecnickcom/tc-lib-unicode-data.git"
        }
    ]
}
```


## Packaging

This library is mainly intended to be used and included in other PHP projects using Composer.
However, since some production environments dictates the installation of any application as RPM or DEB packages,
this library includes make targets for building these packages (`make rpm` and `make deb`).
The packages are generated under the `target` directory.

When this library is installed using an RPM or DEB package, you can use it your code by including the autoloader:
```
require_once ('/usr/share/php/Com/Tecnick/Unicode/Data/autoload.php');
```


## Developer(s) Contact

* Nicola Asuni <info@tecnick.com>