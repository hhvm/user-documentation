# HHVM and Hack User Documentation

This is the new repo for the revamped HHVM and Hack user documentation. [docs.hhvm.com](docs.hhvm.com) is (hopefully) changing for the better. [Contributions](CONTRIBUTING.md) and [feedback](https://github.com/hhvm/user-documentation/issues/new) are welcome.

## Why?

While initially serving its purpose, we are finding the current documentation at [docs.hhvm.com](docs.hhvm.com) limiting in many ways, both in infrastructure and content. So we decided a new approach was in order. You will see the efforts of this approach live and unfiltered; this repo is public from the beginning.

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

The what will be the ["old" documentation repo](https://github.com/hhvm/hack-hhvm-docs) is basically read-only from this point forward (save for critical documentation / infrastructure bugs). When we are ready to launch [docs.hhvm.com](docs.hhvm.com) with the new content, we will then rename the repo *hack-hhvm-docs-legacy* to ensure that its known that the repo is no longer used or maintained.

## Follow Along

Follow along with our progress. We have made this repo open from the start and you will see everything that happens from our very first commit.

If you see anything egregious, you can [file an issue](https://github.com/hhvm/user-documentation/issues/new) or ping us at #hhvm-dev on Freenode IRC or [hhvm.dev on Facebook](https://www.facebook.com/groups/hhvm.dev/)

## Contribute

If you would like to contribute content, checkout the [contributing information](CONTRIBUTING.md)

## Composer Dependencies

To run some of the examples, we require some third-party libraries (e.g., `asio-utilities`). We use `composer` to download and install these dependencies. You will need `composer.phar` (either [download it](https://getcomposer.org/download/) or it might already be in your path). From the root of your checkout:

```
%~/user-documentation] hhvm composer.phar install
```

This will install all dependicies within the `vendor` directory.

## Building the API Docs

We extract the reference documentation from HHVM's source tree - both the
implementation itself, and Hack's data.

1. Clone the HHVM repository - you might want --depth=1
2. Copy LocalConfig.php.example to LocalConfig.php, and adjust the
   `HHVM_TREE` constant
3. Run `composer install`
4. Run `hhvm bin/build.php`
5. The built documentation is now in `build/`

**NOTE**: You may have install a Ruby gem before doing the building. See
[the md-render README](md-render/README.md) for details.
