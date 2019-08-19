# Detailed Local Site Installation Instructions

This is the detailed installation instructions for building the docs locally. You are usually here if you are having problems with the [simple instructions](README.md#build-the-site-locally).

## Packages Prerequisites

Here are the required packages that you will need to build the site. If on something like Ubuntu, for example, you will normally `apt-get install` these. These packages assume an Ubuntu install. You may need `sudo` for these instructions.

First `apt-get update`.

* `apt-get install ruby1.9.3`
* `apt-get install build-essential zlib1g-dev`
* `apt-get install git` # You most likely have this already

## Configuration

The API reference documentation is generated from the HHVM source, so a copy of
that is needed:

Clone the [HHVM repository](https://github.com/facebook/hhvm) to the same parent directory - you might want `--depth=1`

*NOTE*: The configuration and dependency process requires network access, so if you are behind a proxy, take any steps necessary to be able to get through it.

## PHP Dependencies: Composer

We use Composer to manage our PHP library dependencies and to autoload classes.
If you don't have it already, you can download it from
[the Composer website](https://getcomposer.org/).

To install our dependencies and the autoload map in `vendor/`:

```
$ cd user-documentation
user-documentation$ php /path/to/composer.phar install
```

**NOTE**: We try to keep this entire repo typechecker clean. i.e., if you run `hh_client`, you should see `No errors!`. If you are seeing errors in `vendor/`, then first try to run `php composer.phar install` or `php composer install` in the repo to make sure all dependencies are up to date.

**NOTE**: If you add, delete or rename a class in the primary source tree `src/`, you should run `php composer.phar dump-autoload` in order to make the autoload maps refresh correctly; otherwise you will get class not found exceptions.
