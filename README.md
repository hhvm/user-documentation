# HHVM and Hack User Documentation

This is the new repo for the revamped HHVM and Hack user documentation. [docs.hhvm.com](http://docs.hhvm.com) is (hopefully) changing for the better. [Contributions](CONTRIBUTING.md) and [feedback](https://github.com/hhvm/user-documentation/issues/new) are welcome.

## Why?

While initially serving its purpose, we found that the current documentation generated from the [old repo](https://github.com/hhvm/hack-hhvm-docs) limited us in many ways, both in infrastructure and content. So we decided a new approach was in order. You will see the efforts of this approach live and unfiltered; this repo is public from the beginning.

## What?

We are focusing on a few key areas for this revamp:

* **User Documentation**: This repo. We realized that finding out how to do simple things like setting up HHVM to more complicated things like using `async` were more tedious than they should be. The documentation should be a friend, not a nuisance.
* **API Reference**: We are going to use our own documentation (mostly via HNI) for Hack and HHVM specific API documentation. And for anything PHP specific, we will point to [php.net](http://php.net). This serves two purposes:
    - Our source code will serve as the source of truth
    - We won't duplicate PHP documentation, and [their documentation](http://php.net) will serve as the source of truth for PHP-specific documentation
* **Infrastructure**: An easier, more modular and scalable way for documentation. Markdown, not docbook, for [user-guide](https://github.com/hhvm/user-documentation/tree/master/guides) content. Easy to follow, Hack-based [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site.

## How?

Our strategy to create better documentation begins with a re-thinking of our doc infrastructure.

* Markdown instead of docbook provides an easier path for documentation source readability and updates.
    - Have extensions to support things like example insertion, etc.
* Token scan our the HHVM code block documentation (instead of reflection) so that rebuilding HHVM isn't necessary to update the documentation.
  - Use [phpDocumentor](http://www.phpdoc.org/) for docblock parsing 
* Ensure the source code that builds the site is as reusable as possible, so that it has the potential to provide reusability to documentation projects beyond Hack and HHVM.

Check out the [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site. [`bin/build.php`](https://github.com/hhvm/user-documentation/blob/master/bin/build.php) is where all the execution begins.

## Old Repo

The what will be the ["old" documentation repo](https://github.com/hhvm/hack-hhvm-docs) is basically read-only from this point forward (save for critical documentation / infrastructure bugs). When we are ready to launch [docs.hhvm.com](http://docs.hhvm.com) with the new content, we will then rename the repo *hack-hhvm-docs-legacy* to ensure that its known that the repo is no longer used or maintained.

## Follow Along

Follow along with our progress. We have made this repo open from the start and you will see everything that happens from our very first commit.

If you see anything egregious, you can [file an issue](https://github.com/hhvm/user-documentation/issues/new) or ping us at #hhvm-dev on Freenode IRC or [hhvm.dev on Facebook](https://www.facebook.com/groups/hhvm.dev/)

## Local Site Installation

If you would like to build the site locally (e.g., to test your [content contributions](#contributing-content)), you will need to install and configure your system to be able to build and run the site locally.

### Configuration

The API reference documentation is generated from the HHVM source, so a copy of
that is needed:

1. Clone the HHVM repository anywhere convenient - you might want `--depth=1`
2. Copy `LocalConfig.php.example` to `LocalConfig.php`
3. Adjust the `LocalConfig::HHVM_TREE` constant to point to your checkout of
   HHVM

*NOTE*: The configuration and dependency process requires network access, so if you are behind a proxy, take any steps necessary to be able to get through it.

### PHP Dependencies: Composer

We use Composer to manage our PHP library dependencies and to autoload classes.
If you don't have it already, you can download it from
[the Composer website](https://getcomposer.org/).

To install our dependencies and the autoload map in `vendor/`:

```
$ cd user-documentation
user-documentation$ hhvm /path/to/composer.phar install
```

**NOTE**: We try to keep this entire repo typechecker clean. i.e., if you run `hh_client`, you should see `No errors!`. If you are seeing errors in `vendor/`, then first try to run `hhvm composer.phar install` or `hhvm composer install` in the repo to make sure all dependencies are up to date.

### Ruby Dependencies: Bundler

We use the GitHub-Flavored-Markdown pipeline to provide a familiar syntax, and SASS to provide CSS files from structured SCSS source.
As these are written in Ruby, dependencies aren't managed by Composer: the
similar Bundler tool is used instead.

If you do not already have a `bundle` executable in your path, either install
Bundler for all users:

```
$ sudo gem install bundler
```

... or, just for yourself:

```
$ gem install --user-install bundler
Fetching: bundler-1.10.6.gem (100%)
WARNING:  You don't have /home/fred/.gem/ruby/1.9.1/bin in your PATH,
    gem executables will not run.
    Successfully installed bundler-1.10.6
    1 gem installed
    Installing ri documentation for bundler-1.10.6...
    Installing RDoc documentation for bundler-1.10.6...
```

If you get a similar `WARNING`, modify your `$PATH` variable to include the
directory mentioned in the error.

You can then install the dependencies for this project:

```
$ cd user-documentation
user-documentation$ bundle --path vendor-rb/
Using i18n 0.7.0
Using json 1.8.2
Using minitest 5.5.1
Using thread_safe 0.3.4
Using tzinfo 1.2.2
Using activesupport 4.2.0
Using charlock_holmes 0.7.3
Using escape_utils 1.0.1
Using mime-types 2.4.3
Using rugged 0.22.0b5
Using github-linguist 4.4.2
Using github-markdown 0.6.8
Using mini_portile 0.6.2
Using nokogiri 1.6.6.2
Using html-pipeline 1.9.0
Using bundler 1.10.6
Bundle complete! 3 Gemfile dependencies, 16 gems now installed.
Use `bundle show [gemname]` to see where a bundled gem is installed.
```

### Build The Site

```
$ hhvm bin/build.php
```

This will:

 - parse the API definitions in HHVM and Hack, storing machine-readable
   data and documentation in YAML files
 - create canonical definitions, combining the data obtained from Hack and HHVM
 - generate CSS files from the SCSS source
 - generate Markdown files for the API documentation based on these YAML files
 - render all Markdown (API reference and written guides) to HTML

### Running The Site

Configure a webserver and HHVM to serve the `public/` directory, with all
requests that don't match a file being served by `index.php`. For local
development, HHVM's built-in webserver should be sufficient:

```
$ cd user-documentation/public
user-documentation/public$ hhvm -m server \
  -p 8080 \
  -d hhvm.server.default_document=index.php \
  -d hhvm.server.error_document404=index.php
```

## Contributing Content

In order to contribute to the site, first make sure you understand the [contribution guidelines](CONTRIBUTING.md).

You can contribute to the site through [pull requests](https://github.com/hhvm/user-documentation/pulls).

If you want to test your changes locally, the make sure you have followed the [installation instructions](#local-site-installation) for locally building the site.

## Local Snapshot of Site

If you don't have any desire to [build the site](#local-site-installation) (e.g., to test [content changes](#contributing-content)), but want to run a snapshot copy of the site locally, offline, then you can use Docker to do this.

- First, install the [Docker Engine](https://docs.docker.com/) on your platform
- Then:

```
% docker pull hhvm/user-documentation # get the latest version of the site.
% docker run -p 1234:80 hhvm/user-documentation # run web server
```

-. Finally, open `http://localhost:1234` in your browser.

## Running the Examples

Nearly all of the code examples you see in the guides and API documentation are actual Hack or PHP source files that are embedded at site build time into the content itself.

As opposed to embedded the code examples directly within the markdown itself, this provides the flexibility of actually having running examples within this repo.

You must have HHVM installed in order to run these examples since most of them are written in Hack (e.g., `<?hh`), and HHVM is the only runtime to currently support Hack.

You will find the examples in directories named with the pattern:

```
guides/[hhvm | hack]/##-topic/##-subtopic-examples
```

e.g.,

```
guides/hack/23-collections/06-constructing-examples
```

### Standalone

You can run any example standalone. For example:

```
# Assuming you are in the user-documentation repo directory
% cd guides/hack/23-collections/10-examples-examples/
% hhvm lazy.php
```

And you will see output like:

```
object(HH\Vector)#4 (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non lazy: 0.10859489440918
object(HH\Vector)#10 (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non lazy: 0.0096559524536133
```

### Using the HHVM Test Runner

Each example is structured to be run with the [HHVM test runner](https://github.com/facebook/hhvm/blob/master/hphp/test/README.md). We use the test runner internally to ensure that any changes made to HHVM do not cause a regression. The examples in the documentation here can be used for that purpose as well.

You can run the HHVM test runner on the entire suite of examples, on one directory of examples or just one example itself. 

Assuming you have installed and **compiled** HHVM from source, here is how you can run the examples with the test runner:

```
# Assuming you are in the user-documentation repo root

# This runs every example in the test runner
% hhvm /path/to/hhvm/source/hphp/test/run .
# This runs every example in the test runner in typechecker mode
% hhvm /path/to/hhvm/source/hphp/test/run --typechecker .

# This runs all collections topic examples in the test runner
% hhvm /path/to/hhvm/source/hphp/test/run guides/hack/23-collections
# This runs all collections topic examples in test runner in typechecker mode
% hhvm /path/to/hhvm/source/hphp/test/run guides/hack/23-collections --typechecker .
```

Here is the output you should see when you run the test runner. Assume we are running the examples in the collections topic:

```
$ hhvm ~/hhvm/hphp/test/run guides/hack/23-collections/
Running 32 tests in 32 threads (0 in serial)

All tests passed.
              |    |    |
             )_)  )_)  )_)
            )___))___))___)\
           )____)____)_____)\
         _____|____|____|____\\__
---------\      SHIP IT      /---------
  ^^^^^ ^^^^^^^^^^^^^^^^^^^^^
    ^^^^      ^^^^     ^^^    ^^
         ^^^^      ^^^

Total time for all executed tests as run: 11.57s
```

You can use `--verbose` to see all the tests that are running.

**NOTE** that due to some discovered bugs in HHVM and/or third-party libraries, running the test runner on *all* the examples may not give you a 100% pass rate. These bugs are being looked at.
