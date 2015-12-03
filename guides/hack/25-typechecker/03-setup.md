Once the [typechecker is installed](install.md), you need to setup your code so that the typechecker can be used.

## `.hhconfig`

Firstly, you will need an `.hhconfig` file. This file is many times empty (e.g., just `touch .hhconfig`), but there can be [configuration settings](#configuration-settings) added to this file as well.

The `.hhconfig` file should go in the top-level directory of your project codebase. The typechecker needs to globally analyze your code in order to do proper typechecking, and so it needs to know where the root of your project is. It uses the `.hhconfig` file for this -- when invoking the `hh_client` typechecker, it will look for the first `.hhconfig` it can find at or above the current directory, and then check all files under the location where the `.hhconfig` resides.

The normal sequence to create a new `.hhconfig` and run the typechecker for the first time is as follows:

```
%(root project directory) touch .hhconfig
# Then run the typechecker client.
%(root project directory) hh_client
```

## Common Configuration Options

Normally a default, empty `.hhconfig` will serve fine for type checking. However, there are a few configuration options that can be put inside a `.hhconfig` file.

### `assume_php`

**Default value**: `true`
**Usage**: `assume_php = false`

In [strict mode files](modes.md#strict-mode), the typechecker has the luxury of assuming everything that code references is also in Hack, since PHP compatibility is disabled (among other things). [Partial mode files](modes.md#partial-mode) don't have this luxury. Since partial mode has full interoperability with PHP, code therein is allowed to call PHP functions and manipulate PHP classes -- code the typechecker can't see. This means that when the typechecker sees a class or function name in a partial mode file that it knows nothing about, it must assume that class or function is defined in a PHP file it can't see, and must allow the code to pass.

This works well for PHP compatibility, and is typically what you want in a partially converted codebase. However, it has some downsides -- most notably, it won't catch typos or accidental references to classes that really don't exist. Those problems will manifest only at runtime.

The `assume_php` option controls this behavior. Its default value, `true`, works as described above. When set to `false`, then the typechecker no longer assumes that references in partial mode files to classes and functions it doesn't know about must be valid in a PHP file it can't see. It raises an error for this in partial mode files just like it would for strict mode files. This helps coverage of partially converted codebases immensely. In order to get this increased coverage, however, all of your code must of course be visible to the typechecker, of course -- your conversion must be far enough along that all code is in Hack files (even if it's only [decl mode](modes.md#decl-mode)). The code does *not* need to be fully converted to strict mode; getting this increased coverage outside of strict mode is the point of this option.

### `user_attributes`

**Default value**: empty
**Usage**: `user_attributes = CustomAttribute1 CustomAttribute2`

You can populate the `user_attributes` configuration settings with all of your [custom user attributes](../attributes/introduction.md). The primary use of this setting is to help ensure that you are not misspelling any attributes within your codebase. It also ensures that you can keep track of what attributes should be used to avoid any rogue attributes from being added to your code.

## Advanced Configuration Options

You almost certainly do not need to change any of these options, and will break things if you do so improperly. They are included here for completeness.

### Memory

These are for advanced tweaking of how the typechecker uses memory. Unless your codebase consists of more than 10,000,000 lines of code, you won't need to change these.

- `gc_minor_heap_size` -- standard configuration parameter for OCaml GC
- `gc_space_overhead` -- standard configuration parameter for OCaml GC
- `sharedmem_global_size` -- size of region the typechecker uses to store global type information about your codebase
- `sharedmem_heap_size` -- size of total region shared between threads used for both permanent and temporary storage when typechecking

### `unsafe_xhp`

**Default value**: `false`
**Usage**: `unsafe_xhp = true`

Setting this option to `true` seriously cripples the typechecker's analysis of XHP files, completely hiding certain large classes of errors when working with XHP. This is only useful if you manually added Hack types to certain ancient versions of the XHP library, before Hack support was added directly into the library, and then haven't upgraded in the ensuing 4 years. (If you are wondering if you fall into this category, you do not.)
