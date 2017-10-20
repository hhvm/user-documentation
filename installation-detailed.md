# Detailed Local Site Installation Instructions

This is the detailed installation instructions for building the docs locally. You are usually here if you are having problems with the [simple instructions](README.md#build-the-site-locally).

## Packages Prerequisites

Here are the required packages that you will need to build the site. If on something like Ubuntu, for example, you will normally `apt-get install` these. These packages assume an Ubuntu install. You may need `sudo` for these instructions.

First `apt-get update`.

* `apt-get install ruby1.9.3 bundler`
* `apt-get install build-essential zlib1g-dev`
* `apt-get install python-pygments`
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
user-documentation$ hhvm /path/to/composer.phar install
```

**NOTE**: We try to keep this entire repo typechecker clean. i.e., if you run `hh_client`, you should see `No errors!`. If you are seeing errors in `vendor/`, then first try to run `hhvm composer.phar install` or `hhvm composer install` in the repo to make sure all dependencies are up to date.

**NOTE**: If you add, delete or rename a class in the primary source tree `src/`, you should run `hhvm composer.phar dump-autoload` in order to make the autoload maps refresh correctly; otherwise you will get class not found exceptions.

## Ruby Dependencies: Bundler

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
