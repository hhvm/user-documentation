# HHVM and Hack User Documentation [![Build Status](https://travis-ci.org/hhvm/user-documentation.svg?branch=master)](https://travis-ci.org/hhvm/user-documentation)

This is the repo for the [HHVM and Hack user documentation](http://docs.hhvm.com). [Contributions](CONTRIBUTING.md) and [feedback](https://github.com/hhvm/user-documentation/issues/new) are welcome.

If you see anything egregious, you can [file an issue](https://github.com/hhvm/user-documentation/issues/new) or ping us at #hhvm-dev on Freenode IRC or [hhvm.dev on Facebook](https://www.facebook.com/groups/hhvm.dev/)

## What?

There are three keys areas to this repo:

* **User Documentation**: The [guides](https://github.com/hhvm/user-documentation/tree/master/guides). We realized that finding out how to do simple things like setting up HHVM to more complicated things like using `async` were more tedious than they should be. The documentation should be a friend, not a nuisance.
* **API Reference**: We use our own HHVM code documentation for Hack and HHVM specific API documentation. And for anything PHP specific, we defer to [php.net](http://php.net). This serves two purposes:
    - The HHVM source code is the source of truth
    - We don't duplicate PHP documentation, and [their documentation](http://php.net) will serve as the source of truth for PHP-specific documentation
* **Infrastructure**: An easier, more modular and scalable way for documentation. Markdown, not docbook, for [user-guide](https://github.com/hhvm/user-documentation/tree/master/guides) content. Easy to follow, Hack-based [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site.

## How?

Our strategy to create better documentation begins with a re-thinking of our doc infrastructure.

* Markdown instead of docbook provides an easier path for documentation source readability and updates.
    - Have extensions to support things like example insertion, etc.
* Token scan our the HHVM code block documentation (instead of reflection) so that rebuilding HHVM isn't necessary to update the documentation.
  - Use [HHAST](https://github.com/hhvm/hhast) and [hh-apidoc](https://github.com/hhvm/hh-apidoc) for docblock parsing
* Ensure the source code that builds the site is as reusable as possible, so that it has the potential to provide reusability to documentation projects beyond Hack and HHVM.

Check out the [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site. [`bin/build.php`](https://github.com/hhvm/user-documentation/blob/master/bin/build.php) is where all the execution begins.

## Running A Local Copy

If you just want to run a local copy of the site and do not want to make
any changes whatsoever, you can run a snapshot from Docker instead of
building the site:

1. Install [Docker](https://docs.docker.com/engine/installation/)
2. `docker run -p 8080:80 -d hhvm/user-documentation`; this will output a
   container ID
3. You can then access a local copy of the documentation at
   `http://localhost:8080`
4. To stop the instance, run `docker stop ID_FROM_STEP_2_ABOVE`. If you don't
   have a copy of that ID any more, run `docker ps` and use the container name
   in the right-most column instead.

## Building The Site

If you would like to build the site locally (e.g., to test your [content contributions](CONTRIBUTING.md)), you will need to install and configure your system to be able to build and run the site locally.

These are the basic step-by-step instructions to get you up and running. It assumes certain packages are installed on your system. Click [here](installation-detailed.md) for detailed installation information.

1. Clone this repository
1. `cd path/to/user-documentation`
1. `php /path/to/composer.phar install` # Make sure you have composer downloaded
1. `hhvm bin/build.php` # build the site!

Follow the next steps to access this build from a browser.

## Running The Site From A Checkout

Configure a webserver and HHVM to serve the `public/` directory, with all
requests that don't match a file being served by `index.php`. For local
development, HHVM's built-in webserver should be sufficient:

```
$ cd public
$ hhvm -m server -p 8080 -c ../hhvm.dev.ini
```

Then, in your browser, go to http://localhost:8080
