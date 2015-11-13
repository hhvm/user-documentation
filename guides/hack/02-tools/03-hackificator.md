# The Hackificator

While you should always start new projects with Hack (`<?hh`), we realize that there is a whole vast PHP codebase out there that cannot be thrown away or rewritten from scratch. 

The Hackificator is the *first* tool to use to begin converting your PHP codebase to Hack. 

```
hackificator [options] <directory or file path>
```

If you want to see all the options available to the Hackificator, you can see the help via `hackificator --help`.

## Hackifying PHP Code

First, put a `.hhconfig` file in the top root of your codebase. This is required.

Then, when running the Hackificator, it scans your project/codebase for PHP files and does two steps:

1. Converts your file from `<?php` to `<?hh`. At this point you are officially a Hack file.
2. It makes some *super simple* changes to your code to help stop Hack typechecker errors. For example, if you gave a type-hinted parameter a `null` default value, it will normally be prepended with nullable `?`.

Here is an example of a conversion:

```
<?php

class A {}

function foo(A $a = null) {
  return true;
}
```

to:

```
<?hh

class A {}

function foo(?A $a = null) {
  return true;
}
```

Note we did not add any type annotations for the return type of `foo`. This will come later with [`hh_server --convert`](./hhserver.md#automatic-type-annotations).

Also, it is important to note that if you already have any Hack files in the project that you are trying to hackify, they must be typechecker clean. i.e., running `hh_client` must produce `No errors!`.

## Upgrading Hack Typechecker Modes

You can also use the hackificator to upgrade current Hack files (*not PHP files*) to the strictest [mode](./typechecker/modes.md) possible. So, for example, you can use it to go from `partial` to `strict` mode, assuming a conversion to `strict` mode won't cause any typechecker errors.

```
hackificator --upgrade <directory or file path>
```
