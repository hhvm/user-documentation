In most cases, [running `hh_client`](04-running.md) without any explicit options passed to it is all you will need to do. However, there are options that can be passed to `hh_client` in order to access code data beyond the typechecking of code.

This section will not cover all the options. To see all the options, you can utilize the help via `hh_client --help`.

The following example will be used in discussion of these options:

@@ options-examples/options.php @@

**NOTE**: Many of these options support namespaced classes and function as their symbols. Just make sure you quote the string. e.g.,

```
hh_client --find-class-refs "\Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass"
```

## `--check`

`--check` is the default command to `hh_client`, signifying that the typechecker should do what it normally does ... check for type errors.

All of the options below (except the starting and stopping of the server) are actually options to this `--check` command. The following are equivalent

```
hh_client --check [OPTION]
hh_client [OPTION]
```

## `--start`

`--start` (and its sister commands `--stop` and `--restart`) should not have to be used often, but they do let you control the Hack server `hh_server`. You may want to stop the server if you are in a rotten or random state, for example.

## `--list-modes`

`--list-modes` will print a list of all the files monitored by the Hack server and let you know which of the [three modes](05-modes.md) (or `<?php`) each file is in.

```
:
:
strict  user-documentation/hack/16-typechecker/modes-examples/call-into-decl.php
decl    user-documentation/hack/16-typechecker/modes-examples/decl.php
partial user-documentation/hack/16-typechecker/modes-examples/main-function.php
php user-documentation/hack/16-typechecker/modes-examples/multiple-modes.php
php user-documentation/hack/16-typechecker/modes-examples/non-hack-code.php
partial user-documentation/hack/16-typechecker/modes-examples/partial.php
strict  user-documentation/hack/16-typechecker/modes-examples/strict.php
:
:
```

## `--search`

If you provide this option with a string representing a symbol, then `hh_client` will search for files it knows about for that symbol, and annotate the results with whether it found a function, class, etc.

```
hh_client --search VeryUnique
File "options.php", line 5, characters 7-21: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass, class
File "options.php", line 18, characters 10-27: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueFunction, function
File "options.php", line 11, characters 7-28: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueGenericClass, class
```

You can refine the search with the sister options `--search-class`, `--search-function`, `--search-typedef`, `--search-constant`.

## `--find-refs`

`--find-refs` and its sister `--find-class-refs` find references to a named function or class, respectively.

```
hh_client --find-class-refs "\Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass"
File "options.php", line 19, characters 12-26: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass::__construct
File "options.php", line 13, characters 36-50: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass
2 total results
```

## `--inheritance-children`

`--inheritance-children` and its sister `inheritance-ancestor` prints, given a class name, prints inheritance information.

```
hh_client --inheritance-children "\Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass"
File "options.php", line 5, characters 7-21: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClass
    inherited by File "options.php", line 26, characters 7-26: Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueClassChild
```

## `--type-at-pos`

`--type-at-pos` tells `hh_client` to try to determine the type of a specific expression. It takes the following form:

```
hh_client --type-at-pos options.php:22:3
```

where you provide a filename, line number and column number separated by colons. The column number is the hardest part to determine. A variable, for example, is the column of the actual start of the name of the variable, not including the `$`.

```
hh_client --type-at-pos options.php:22:3
Hack\UserDocumentation\TypeChecker\Options\Examples\Options\VeryUniqueGenericClass
```

## `--list-files`

This will list all of the files monitored by the Hack server that have typing errors.

## `--stats`

This will provide a json-based representation of the internal statistics regarding the Hack server, particularly around the area of memory.

```
hh_client --stats
{
  "init_parsing_heap_size":3375552,
  "init_heap_size":10226176,
  "max_heap_size":12275072
}
```
