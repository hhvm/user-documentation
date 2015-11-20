Once the [typechecker is installed](install.md), you need to setup your code so that the typechecker can be used.

## `.hhconfig`

Firstly, you will need an `.hhconfig` file. This file is many times empty (e.g., just `touch .hhconfig`), but there can be [configuration settings](#configuration-settings) added to this file as well.

The `.hhconfig` file should go in the top-level directory of your project codebase so the typechecker can include every source file in its analysis.

The normal sequence is as follows:

```
%(root project directory) touch .hhconfig
# The run the typechecker client.
%(root project directory) hh_client
```

## Configuration Settings

Normally a default, empty `.hhconfig` will serve fine for type checking. However, there are a few configuration options that can be put inside a `.hhconfig` file.

### `assume_php`

**Default value**: `true`
**Usage**: `assume_php = false`

Normally, if the typechecker encounters a name (e.g., a class name) that it cannot find in its analysis tree, it assumes that name is found in a non-checkable PHP file. Setting `assume_php` to `false` will thwart that assumption and the typechecker will error with `Unbound name` on any name it cannot find.

**NOTE**: In [`// strict` mode](modes.md#strict-mode), the typechecker always errors on unbound names.

### `user_attributes`

**Default value**: empty
**Usage**: `user_attributes = CustomAttribute1 CustomAttribute2`

You can populate the `user_attributes` configuration settings with all of your [custom attributes](../attributes/introduction.md). The primary use of this setting is to help ensure that you are not misspelling any attributes within your codebase. It also ensures that you can keep track of what attributes should be used to avoid any rogue attributes from being added to your code.


### Memory

These are for advanced tweaking of how the typechecker uses memory. The defaults should generally be sane.

<< ADD DEFAULT VALUES FOR THESE >>

- `gc_minor_heap_size`
- `gc_space_overhead`
- `sharedmem_global_size`
- `sharedmem_heap_size`
