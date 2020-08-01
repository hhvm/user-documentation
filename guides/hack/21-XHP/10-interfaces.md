There are two important interfaces in XHP, `XHPRoot` and `XHPChild`, that you will need to use these when adding type annotations to functions.

## XHPRoot

The `XHPRoot` interface is a implemented by all XHP objects; in practice, this means:
 - `:x:element` subclasses -- these are classes that re-use (and combine) existing XHP classes
 - `:x:primitive` subclasses -- these define basic elements, such as `:x:frag`, and all of the basic HTML elements
 - implementations of the [`XHPUnsafeRenderable`](#xhpunsaferenderable) interface described below

## XHPChild

XHP presents a tree structure, and this interface defines what can be valid child nodes of the tree; it includes:
 - All implementations of `XHPRoot`
 - strings, integers, floats
 - arrays of any of the above

Despite strings, integers, floats, and arrays not being objects, both the typechecker and HHVM consider them to implement this interface,
for parameter/return types and for `is` checks.

## Advanced Interfaces

While XHP's safe-by-default features are usually beneficial, occasionally they need to be bypassed; the most common cases are:
 - Needing to embed the output from another template system when migrating to XHP.
 - Needing to embed HTML from another source, for example, Markdown or BBCode renderers.

XHP usually gets in the way of this by:
 - Escaping all variables, including your HTML code.
 - Enforcing child relationships - and XHP objects can not be marked as allowing HTML string children.

The `XHPUnsafeRenderable` and `XHPAlwaysValidChild` interfaces allow bypassing these safety mechanisms.

## XHPUnsafeRenderable

If you need to render raw HTML strings, wrap them in a class that implements this interface and provides a `toHTMLString: string` method:

@@ interfaces-examples/xss-security-hole.inc.php @@
@@ interfaces-examples/xss-security-hole.php @@

We do not provide an implementation of this interface as a generic implementation tends to be overused; instead, consider making more specific
implementations:

@@ interfaces-examples/markdown-wrapper.inc.php @@
@@ interfaces-examples/markdown-wrapper.php @@

## XHPAlwaysValidChild

XHP's child validation can be bypassed by implementing this interface. Most classes that implement this interface are also implementations of
`XHPUnsafeRenderable`, as the most common need is when a child is produced by another rendering or template system.

This can also be implemented by XHP objects, but this usually indicates that a child class specification should be replaced with a category. This
interface is intentionally breaking part of XHP's safety, so should be used as sparingly as possible.

## Example

@@ interfaces-examples/all-in-one.inc.php @@
@@ interfaces-examples/all-in-one.php @@
