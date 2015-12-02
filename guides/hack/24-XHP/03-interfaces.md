There are two important interfaces in XHP, `XHPRoot` and `XHPChild`; you will need to use these when adding type annotations to functions.

## XHPRoot

The `XHPRoot` interface is a implemented by all XHP objects; in practice, this means:

 - `:x:element` subclasses - these are classes that re-use (and combine) existing XHP classes
 - `:x:primitive` subclasses - these define basic elements, such as `:x:frag`, and all of the basic HTML elements
 - implementations of the [`XHPUnsafeRenderable`](#xhpunsaferenderable) interface described below

## XHPChild

XHP presents a tree structure, and this interface defines what can be valid child nodes of the tree; it includes:

 - All implementations of `XHPRoot`
 - strings, integers, floats
 - arrays of any of the above

Despite strings, integers, floats, and arrays not being objects, both the typechecker and HHVM consider them to implement this interface, as shown by `instanceof()` checks:

TODO: implement this example.

@@ interfaces/xhpchild.php @@

## XHPUnsafeRenderable

XHP automatically escapes all content passed to it, but occassionally you have an HTML string that must be rendered exactly as-is, without escaping. the `XHPUnsafeRenderable` interface provides a way to do that by implementing a `toHTMLString(): string` method.

## XHPAlwaysValidChild

TODO
