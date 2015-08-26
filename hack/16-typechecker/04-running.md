Running the typechecker is simple. For most users and most purposes, it is a one-line command, called `hh_client`.

## `hh_client`

`hh_client`, for all intents and purposes, is the typechecker. Assuming you have [installed](02-install.md) everything properly and you have added a [`.hh_config`](03-setup.md) file to the root of your codebase, then to get typechecking started:

```
%(root of codebase) hh_client
```

Here is an example of some Hack code and how it is checked.

@@ running-examples/simple-check.php @@

Let's examine the error message for the call to `a("5")`:

```
simple-check.php:13:14,16: Invalid argument (Typing[4110])
  simple-check.php:5:12,14: This is an int
  simple-check.php:13:14,16: It is incompatible with a string
```

The `Invalid argument` line is telling you where the actual error was spotted. In our case, the call to `a("5")` is what caused the error. 

**NOTE**: The `Typing[4110]` is a status code from the server. This code can be used with something like [`HH_FIXME`](link to discussion on HH_FIXME)

The `This is an int` line is letting you know what the typechecker expected you to do. It is basically saying your call to `a()` should have provided an `int`.

The `It is incompatible with a string` line is letting you know what you did to cause the typechecker to error. In this case, you passed a `string` to `a()` instead of an `int`.

### `hh_server`

When you run `hh_client`, it checks to see if the typechecker server, `hh_server` is currently running. If not, the server is spun up. Otherwise, the current instance of the server is used.

The server is the backend infrastructure doing all of the type analysis on your code. It is continuous. That is why `hh_client` is near instantaneous in reporting errors.

### Type checks only Hack files

The typechecker only checks Hack files; that is files that start with `<?hh`. So if your codebase is all `<?php`, the typechecker will not be much use to you and will just report `No errors!`.  

### Autoload

The typechecker assumes that all usable code in your project can be used from anywhere in your project. There is no checking whether your `require` and `include` statements are accurate and correct. If they are not, you will be bitten at runtime instead.

Of course, if your code is one file, this point is moot. But once you start having a project that has multiple files autoloading becomes very useful. If you don't autoload, the typechecker will still typecheck correctly, but it won't be able to tell that you forgot to include some file with necessary code to actually run.

@@ running-examples/autoloading.php @@

Let's say we forgot to put a require here to get access to the code for class `B`. Without the autoloading code, if you run `hh_client,` you will get `No errors!`. Great, right? Well, not really. The typechecker did the right thing, but you will get a fatal at *runtime*.

```
Fatal error: Class undefined: Hack\UserDocumentation\TypeChecker\Intro\Examples\Autoloading\B
```

With the autoloading of the file that contains `B`, you can accidentally forget the `require`s, but still your code will run correctly.

```
int(5)
```
