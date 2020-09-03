There are two important XHP types, the `\XHPChild` interface (HHVM built-in) and
the `\Facebook\XHP\Core\node` base class (declared in XHP-Lib). You will most
commonly encounter these in functions' return type annotations.

## `\XHPChild`

XHP presents a tree structure, and this interface defines what can be valid child nodes of the tree; it includes:

- all subclasses of `\Facebook\XHP\Core\node` and the advanced interfaces
  described below
- strings, integers, floats
- arrays of any of the above

Despite strings, integers, floats, and arrays not being objects, both the typechecker and HHVM consider them to implement this interface,
for parameter/return types and for `is` checks.

## `\Facebook\XHP\Core\node` (`x\node`)

The `\Facebook\XHP\Core\node` base class is implemented by all XHP objects, via
one of its two subclasses:

- `\Facebook\XHP\Core\element` (`x\element`): most common; subclasses implement a
  `renderAsync()` method that returns another `node`, and XHP-Lib automatically
  takes care of recursively rendering nested XHP objects
- `\Facebook\XHP\Core\primitive` (`x\primitive`): for very low-level nodes that
  need exact control of how the object is rendered to a string, or when the
  automatic handling of nested XHP objects is insufficient; subclasses implement
  a `stringifyAsync()` method that returns a `string` and must manually deal with
  any children

**Historical note:**
<span class="fbOnly fbIcon">(applies in FB WWW repository)</span>
Before XHP namespace support (in XHP-Lib v3), the names of
`node`, `element` and `primitive` are `\XHPRoot`, `:x:element` and
`:x:primitive` respectively.

The `\Facebook\XHP\Core` namespace is conventionally aliased as `x` (`use Facebook\XHP\Core as x;`), so you might encounter these classes as `x\node`,
`x\element` and `x\primitive`, which also mirrors their historical names.

## Advanced Interfaces

While XHP's safe-by-default features are usually beneficial, occasionally they need to be bypassed; the most common cases are:
 - Needing to embed the output from another template system when migrating to XHP.
 - Needing to embed HTML from another source, for example, Markdown or BBCode renderers.

XHP usually gets in the way of this by:
 - Escaping all variables, including your HTML code.
 - Enforcing child relationships - and XHP objects can not be marked as allowing HTML string children.

The `\Facebook\XHP\UnsafeRenderable` and `\Facebook\XHP\XHPAlwaysValidChild` interfaces allow bypassing these safety mechanisms.

**Historical note:**
<span class="fbOnly fbIcon">(applies in FB WWW repository)</span>
Before XHP namespace support (in XHP-Lib v3), the names of
these interfaces are `\XHPUnsafeRenderable` and `\XHPAlwaysValidChild`.

### `\Facebook\XHP\UnsafeRenderable`

If you need to render raw HTML strings, wrap them in a class that implements this interface and provides a `toHTMLStringAsync()` method:

@@ interfaces-examples/xss-security-hole.inc.php @@
@@ interfaces-examples/xss-security-hole.php @@

We do not provide an implementation of this interface as a generic implementation tends to be overused; instead, consider making more specific
implementations:

@@ interfaces-examples/markdown-wrapper.inc.php @@
@@ interfaces-examples/markdown-wrapper.php @@

### `\Facebook\XHP\AlwaysValidChild`

XHP's child validation can be bypassed by implementing this interface. Most classes that implement this interface are also implementations of
`UnsafeRenderable`, as the most common need is when a child is produced by another rendering or template system.

This can also be implemented by XHP objects, but this usually indicates that some class in `getChildrenDeclaration()` should be replaced with a more generic interface.
`AlwaysValidChild` is intentionally breaking part of XHP's safety, so should be used as sparingly as possible.

## Example

@@ interfaces-examples/all-in-one.inc.php @@
@@ interfaces-examples/all-in-one.php @@
