# HHVM and Hack User Documentation

This is the repo for the [HHVM and Hack user documentation](http://docs.hhvm.com). [Contributions](CONTRIBUTING.md) and [feedback](https://github.com/hhvm/user-documentation/issues/new) are welcome.

If you see anything broken, please [file an issue](https://github.com/hhvm/user-documentation/issues/new).

## Structure

There are three keys areas to this repo:

* **User Documentation**: The [guides](https://github.com/hhvm/user-documentation/tree/master/guides). We realized that finding out how to do simple things like setting up HHVM to more complicated things like using `async` were more tedious than they should be. The documentation should be a friend, not a nuisance.
* **API Reference**: We use our own HHVM code documentation for Hack and HHVM specific API documentation. And for anything PHP specific, we defer to [php.net](http://php.net). This serves two purposes:
    - The HHVM source code is the source of truth
    - We don't duplicate PHP documentation, and [their documentation](http://php.net) will serve as the source of truth for PHP-specific documentation
* **Infrastructure**: An easier, more modular and scalable way for documentation. Markdown for [user-guide](https://github.com/hhvm/user-documentation/tree/master/guides) content. Easy to follow, Hack-based [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site.

Check out the [source code](https://github.com/hhvm/user-documentation/tree/master/src) for building the site. [`bin/build.php`](https://github.com/hhvm/user-documentation/blob/master/bin/build.php) is where all the execution begins.