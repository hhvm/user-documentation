# HHVM and Hack User Documentation

This is the new repo for the revamped HHVM and Hack user documentation. [docs.hhvm.com](http://docs.hhvm.com) is (hopefully) changing for the better. [Contributions](CONTRIBUTING.md) and [feedback](https://github.com/hhvm/user-documentation/issues/new) are welcome.

## Why?

While initially serving its purpose, we are finding the current documentation at [docs.hhvm.com](http://docs.hhvm.com) limiting in many ways, both in infrastructure and content. So we decided a new approach was in order. You will see the efforts of this approach live and unfiltered; this repo is public from the beginning.

## What?

We are focusing on a few key areas for this revamp:

* **User Documentation**: This repo. We realized that finding out how to do simple things like setting up HHVM to more complicated things like using `async` were more tedious than they should be. The documentation should be a friend, not a nusance.
* **API Reference**: We are going to use our own documentation (mostly via HNI) for Hack and HHVM specific API documentation. And for anything PHP specific, we will point to [php.net](http://php.net). This serves two purposes:
    - Our source code will serve as the source of truth
    - We won't duplicate PHP documentation, and their documentation will serve as the source of truth for PHP-specific documentation
* **Infrastructure**: An easier, more modular and scalable way for documentation. Markdown, not docbook, for example. More on this later.

## How?

Our strategy to create better documentation begins with a re-thinking of our doc infrastructure.

* Markdown instead of docbook provides an easier path for documentation source readabibility and updates.
    - Have extensions to support things like cross-references, etc.
* Token scan our HNI documentation (instead of reflection) so that rebuilding HHVM isn't necessary to update the documentation.
* Have some sort of reusable, semantic format created from our API documentation. This has the potential to provide reusability to documentation projects beyond Hack and HHVM.

The above are initial thoughts that will be fleshed out more as we get deeper into the documentation project.

## Old Repo

The what will be the ["old" documentation repo](https://github.com/hhvm/hack-hhvm-docs) is basically read-only from this point forward (save for critical documentation / infrastructure bugs). When we are ready to launch [docs.hhvm.com](http://docs.hhvm.com) with the new content, we will then rename the repo *hack-hhvm-docs-legacy* to ensure that its known that the repo is no longer used or maintained.

## Follow Along

Follow along with our progress. We have made this repo open from the start and you will see everything that happens from our very first commit.

If you see anything egregious, you can [file an issue](https://github.com/hhvm/user-documentation/issues/new) or ping us at #hhvm-dev on Freenode IRC or [hhvm.dev on Facebook](https://www.facebook.com/groups/hhvm.dev/)

## Contribute

If you would like to contribute content, checkout the [contributing information](CONTRIBUTING.md)

## Installation

### Configuration

The API reference documentation is generated from the HHVM source, so a copy of
that is needed:

1. Clone the HHVM repository anywhere convenient - you might want `--depth=1`
2. Copy `LocalConfig.php.example` to `LocalConfig.php`
3. Adjust the `LocalConfig::HHVM_TREE` constant to point to your checkout of
   HHVM

### PHP Dependencies: Composer

We use Composer to manage our PHP library dependencies and to autoload classes.
If you don't have it already, you can download it from
[the Composer website](https://getcomposer.org/).

To install our dependencies and the autoload map in `vendor/`:

```
$ cd user-documentation
user-documentation$ hhvm /path/to/composer.phar install
```

### Ruby Dependencies: Bundler

We use the GitHub-Flavored-Markdown pipeline to provide a familiar syntax.
As this is written in Ruby, dependencies aren't managed by Composer: the
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
$ cd user-documentation/md-render
user-documentation/md-render$ bundle --path vendor/
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
  -v Server.DefaultDocument=index.php \
  -v Server.ErrorDocument404=index.php
